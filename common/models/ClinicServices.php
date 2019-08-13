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
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'subcategory_id', 'status'], 'integer'],
            [['name', 'summary'], 'required'],
            [['name', 'summary', 'file'], 'string', 'max' => 255],
            [['description'], 'string'],
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

    /**
     * Upload supplied images via UploadedFile
     * @return boolean
     */
    public function upload(): bool
    {
        if ($this->validate()) {

            $uploadedImages = UploadedFile::getInstances($this, 'images');

            if (count($uploadedImages) > 0) {

                foreach ($uploadedImages as $key => $uploadedImage) {
                    $image = new ClinicServicesImages;
                    $name = $this->id . '-' . ($key + 1) . '-' . time() . '.' . $uploadedImage->extension;

                    $image->file = $name;
                    $image->service_id = $this->id;

                    if (!$image->saveImages($uploadedImage, $name)) {
                        return false;
                    }

                    if ($key == 0) {
                        $image->cover = (!$this->cover) ? ClinicServicesImages::STATUS_ACTIVE : ClinicServicesImages::STATUS_DELETED;
                    }

                    $image->save();
                }

                return true;

            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCover()
    {
        $cover = $this->hasOne(ClinicServicesImages::className(), ['service_id' => 'id'])
            ->andOnCondition(['cover' => ClinicServicesImages::STATUS_ACTIVE]);

        return ($cover->one()) ? $cover : $this->hasOne(ClinicServicesImages::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(ClinicServicesImages::className(), ['service_id' => 'id']);
    }

    // public function deleteImage(): bool
    // {
    //     $image = $this->getImagefolder() . $this->file;
    //     $imagethumb = $this->getImagethumbfolder() . $this->file;

    //     $this->file = null;

    //     if ($this->save()) {
    //         return (unlink($image) && unlink($imagethumb)) ? true : false;
    //     }

    //     return false;
    // }

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
