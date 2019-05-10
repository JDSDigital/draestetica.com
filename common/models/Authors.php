<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * This is the model class for table "xblog_authors".
 *
 * @property int $id
 * @property string $name
 * @property string $profession
 * @property string $file
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Blog[] $articles
 */
class Authors extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    public $image;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xblog_authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'profession'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'profession', 'file'], 'string', 'max' => 255],
        ];
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nombre',
            'profession' => 'Profesión',
            'file' => 'Archivo',
            'status' => 'Estado',
            'created_at' => 'Creado En',
            'updated_at' => 'Actualizado En',
        ];
    }

    public static function getImagefolder()
    {
        return Yii::getAlias('@frontend/web/img/authors/');
    }

    public static function getImagethumbfolder()
    {
        return Yii::getAlias('@frontend/web/img/authors/thumbs/');
    }

    public static function getFolder()
    {
        $directory = Yii::getAlias('@web/img/authors/');

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

            $name = $this->id . '_' .strtolower(str_replace(' ', '-', $this->name)) . '.' . $uploadedImage[0]->extension;

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

    public static function getList()
    {
        $authors = self::find()->active()->select(['id', 'name'])->asArray()->all();

        return ArrayHelper::map($authors, 'id', 'name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Blog::className(), ['author_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return AuthorsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthorsQuery(get_called_class());
    }
}
