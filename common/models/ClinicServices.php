<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * This is the model class for table "xclinic_services".
 *
 * @property int $id
 * @property int $category_id
 * @property int $subcategory_id
 * @property string $name
 * @property string $summary
 * @property string $description
 * @property string $file
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ClinicServicesCategories $category
 * @property ClinicServicesSubcategories $subcategory
 */
class ClinicServices extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    public $image;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xclinic_services';
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
            [['category_id', 'subcategory_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'summary'], 'required'],
            [['name', 'summary', 'description', 'file'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClinicServicesCategories::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['subcategory_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClinicServicesSubcategories::className(), 'targetAttribute' => ['subcategory_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Categoría',
            'subcategory_id' => 'Subcategoría',
            'name' => 'Nombre',
            'summary' => 'Resumen',
            'description' => 'Descripción',
            'file' => 'Imágen',
            'status' => 'Estado',
            'created_at' => 'Creado En',
            'updated_at' => 'Actualizado En',
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

        Image::resize(self::getImagefolder() . 'tmp-' . $name, 1024, null)
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
    public function getCategory()
    {
        return $this->hasOne(ClinicServicesCategories::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategory()
    {
        return $this->hasOne(ClinicServicesSubcategories::className(), ['id' => 'subcategory_id']);
    }

    /**
     * {@inheritdoc}
     * @return ClinicServicesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClinicServicesQuery(get_called_class());
    }
}
