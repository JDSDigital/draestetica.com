<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public $image;
    public $role_dropdown;
    public $password;
    public $repassword;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%xsystem_users}}';
    }

    public function beforeSave($insert)
    {
    		if ($this->password != '') {
      			$this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
      			$this->auth_key = Yii::$app->security->generateRandomString();
    		}

    		if ($this->created_at == null) {
            $this->created_at = date('U');
        }

        $this->updated_at = date('U');

        $this->updateRole();

        return true;
  	}

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password', 'repassword'], 'required', 'on' => ['create']],
            [
              'repassword',
              'compare',
              'compareAttribute' => 'password',
              'message' => Yii::t('app', 'Las contraseñas deben coincidir.'),
            ],

      			[['email'], 'required'],
            [['email'], 'email'],
      			[['email'], 'unique'],
      			[['name', 'profession', 'email', 'password', 'repassword', 'password_reset_token', 'role_dropdown'], 'string', 'max' => 255],

            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
      return [
        'id' => 'ID',
        'name' => 'Nombre',
        'profession' => 'Profesión',
        'status' => 'Estado',
        'email' => 'Correo',
        'role' => 'Rol',
        'role_dropdown' => 'Rol',
        'created_at' => 'Creado En',
        'updated_at' => 'Actualizado En',
      ];
    }

    public function updateRole(): bool
    {
        if ($this->role_dropdown != $this->role) {
            $auth = Yii::$app->authManager;
            $oldRole = $auth->getRole($this->role);
            $newRole = $auth->getRole($this->role_dropdown);

            if ($oldRole) {
                $auth->revoke($oldRole, $this->getId());
            }

            $auth->assign($newRole, $this->getId());

            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public static function getImagefolder()
    {
        return Yii::getAlias('@frontend/web/img/users/');
    }

    public static function getImagethumbfolder()
    {
        return Yii::getAlias('@frontend/web/img/users/thumbs/');
    }

    public static function getFolder()
    {
        $directory = Yii::getAlias('@web/img/users/');

        return str_replace('admin/', '', $directory);
    }

    public function getImage()
    {
        return self::getFolder() . $this->file;
    }

    public function getThumb()
    {
        return self::getFolder() . 'thumbs/' . $this->file;
    }

    /**
     * Upload supplied images via UploadedFile
     * @return boolean
     */
    public function upload(): bool
    {
        $uploadedImage = UploadedFile::getInstances($this, 'image');

        if (count($uploadedImage) > 0) {

            $name = $this->id . '_' .strtolower(str_replace(' ', '-', $this->email)) . '.' . $uploadedImage[0]->extension;

            $this->file = $name;

            if (!$this->saveImages($uploadedImage[0], $name)) {
                return false;
            }

            if ($this->save()) {
                return true;
            } else {
                return false;
            }
        }

        return true;

    }

    public function saveImages(UploadedFile $uploadedImage, string $name): bool
    {
        $uploadedImage->saveAs(self::getImagefolder() . 'tmp-' . $name);

        Image::resize(self::getImagefolder() . 'tmp-' . $name, 800, null)
        ->save(self::getImagefolder() . $name, ['jpeg_quality' => 80]);

        Image::resize(self::getImagefolder() . 'tmp-' . $name, 300, null)
        ->save(self::getImagethumbfolder() . $name, ['jpeg_quality' => 80]);

        unlink(self::getImagefolder() . 'tmp-' . $name);

        return true;
    }

    public function deleteImage(): bool
    {
        $image = $this->getImagefolder() . $this->file;
        $imagethumb = $this->getImagethumbfolder() . $this->file;

        $this->file = null;

        if ($this->save()) {
            return (unlink($image) && unlink($imagethumb)) ? true : false;
        }

        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignment()
    {
        return $this->hasOne(AuthAssignment::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return ($this->authAssignment) ? $this->authAssignment->item_name : 'No asignado';
    }

    public static function getRoles()
    {
        $response = [];
        $roles = AuthItem::find()->roles()->select(['name'])->asArray()->all();

        foreach ($roles as $role) {
            $response[$role['name']] = ucfirst($role['name']);
        }

        return $response;
    }
}
