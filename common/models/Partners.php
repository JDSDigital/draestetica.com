<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * This is the model class for table "xpartners_logos".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $url
 * @property string $file
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Partners extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    public $image;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xpartners_logos';
    }

    public function beforeSave($insert)
    {
        if (substr( $this->url, 0, 4 ) != "http") {
            $this->url = 'https://' . $this->url;
        }

        return true;
  	}

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'url', 'file'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description', 'url', 'file'], 'string', 'max' => 255],
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
            'description' => 'Descripción',
            'url' => 'Url',
            'file' => 'Imagen',
            'images' => 'Imágenes',
            'status' => 'Estado',
            'created_at' => 'Creado En',
            'updated_at' => 'Actualizado En',
        ];
    }

    /**
     * {@inheritdoc}
     * @return PartnersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PartnersQuery(get_called_class());
    }

    public static function getImagefolder()
    {
        return Yii::getAlias('@frontend/web/img/logos/');
    }

    public static function getFolder()
    {
        $directory = Yii::getAlias('@web/img/logos/');

        return str_replace('admin/', '', $directory);
    }

    public function getLogo()
    {
        return self::getFolder() . $this->file;
    }

    /**
     * Upload supplied images via UploadedFile
     * @return boolean
     */
    public function upload()
    {
        $uploadedImage = UploadedFile::getInstances($this, 'image');

        if (count($uploadedImage) > 0) {

            $name = strtolower(str_replace(' ', '-', $this->name)) . '.' . $uploadedImage[0]->extension;

            $this->file = $name;

            $uploadedImage[0]->saveAs(self::getImagefolder() . 'tmp-' . $name);

            Image::resize(self::getImagefolder() . 'tmp-' . $name, 300, null)
            ->save(self::getImagefolder() . $name, ['jpeg_quality' => 80]);

            unlink(self::getImagefolder() . 'tmp-' . $name);

            return true;
        }

        return false;

    }

    public function deleteImage()
    {
        $image = $this->getImagefolder() . $this->file;

        return (unlink($image)) ? true : false;
    }
}
