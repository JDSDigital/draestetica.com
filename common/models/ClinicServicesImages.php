<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\imagine\Image;
use yii\web\UploadedFile;
use common\models\ClinicServices;

/**
 * This is the model class for table "xclinic_services_images".
 *
 * @property int $id
 * @property int $service_id
 * @property string $file
 * @property int $cover
 * @property int $uploaded_at
 */
class ClinicServicesImages extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xclinic_services_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service_id', 'cover', 'uploaded_at'], 'integer'],
            [['file'], 'string', 'max' => 255],
        ];
    }

    /*
    public function beforeSave($insert)
    {
        return true;
  	}
    */

    // public function behaviors()
    // {
    //     return [
    //         [
    //             'class' => TimestampBehavior::className(),
    //         ],
    //     ];
    // }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Servicio',
            'file' => 'Imágen',
            'cover' => 'Portada',
            'uploaded_at' => 'Subido En',
        ];
    }

    public static function getImagefolder()
    {
        return Yii::getAlias('@frontend/web/img/clinic/services/');
    }

    public static function getImagethumbfolder()
    {
        return Yii::getAlias('@frontend/web/img/clinic/services/thumbs/');
    }

    public static function getFolder()
    {
        $directory = Yii::getAlias('@web/img/clinic/services/');

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
        self::updateAll(['cover' => 0], 'service_id = ' . $this->service_id);

        $this->cover = self::STATUS_ACTIVE;

        if (self::update())
          return true;
        else
          return false;

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }
}
