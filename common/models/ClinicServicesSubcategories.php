<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "xclinic_services_subcategories".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ClinicServices[] $xclinicServices
 */
class ClinicServicesSubcategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xclinic_services_subcategories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getList()
    {
        $subcategories = self::find()->active()->select(['id', 'name'])->asArray()->all();

        return ArrayHelper::map($subcategories, 'id', 'name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClinicServices()
    {
        return $this->hasMany(ClinicServices::className(), ['subcategory_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ClinicServicesSubcategoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClinicServicesSubcategoriesQuery(get_called_class());
    }
}
