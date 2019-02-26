<?php

namespace common\models;

use Yii;

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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'subcategory_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'summary', 'description', 'file'], 'required'],
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
