<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\imagine\Image;
use yii\web\UploadedFile;
use common\models\Social;

/**
 * This is the model class for table "xsocial_images".
 *
 * @property int $id
 * @property int $article_id
 * @property string $file
 * @property int $cover
 * @property int $uploaded_at
 */
class Images extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xsocial_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'cover', 'uploaded_at'], 'integer'],
            [['file'], 'string', 'max' => 255],
        ];
    }

    /*
    public function beforeSave($insert)
    {
        return true;
  	}
    */

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
            'article_id' => 'Artículo',
            'file' => 'Imágen',
            'cover' => 'Portada',
            'uploaded_at' => 'Subido En',
        ];
    }

    public static function getImagefolder() : string
    {
        return Yii::getAlias('@frontend/web/img/social/');
    }

    public static function getImagethumbfolder() : string
    {
        return Yii::getAlias('@frontend/web/img/social/thumbs/');
    }

    public static function getFolder() : string
    {
        $directory = Yii::getAlias('@web/img/social/');

        return str_replace('admin/', '', $directory);
    }

    public function getImage() : string
    {
        return self::getFolder() . $this->file;
    }

    public function getThumb() : string
    {
        return self::getFolder() . 'thumbs/' . $this->file;
    }

    public function saveImages(UploadedFile $uploadedImage, string $name): bool
    {
        $uploadedImage->saveAs(self::getImagefolder() . 'tmp-' . $name);

        Image::resize(self::getImagefolder() . 'tmp-' . $name, 1024, null)
        ->save(self::getImagefolder() . $name, ['jpeg_quality' => 80]);

        Image::resize(self::getImagefolder() . 'tmp-' . $name, null, 300)
        ->save(self::getImagethumbfolder() . $name, ['jpeg_quality' => 80]);

        unlink(self::getImagefolder() . 'tmp-' . $name);

        return true;
    }

    public function setCover()
    {
        self::updateAll(['cover' => 0], 'article_id = ' . $this->article_id);

        $this->cover = self::STATUS_ACTIVE;

        if (self::update())
          return true;
        else
          return false;

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocial()
    {
        return $this->hasOne(Social::className(), ['id' => 'article_id']);
    }

    /**
     * {@inheritdoc}
     * @return ImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImagesQuery(get_called_class());
    }
}
