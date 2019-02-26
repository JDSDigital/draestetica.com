<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "xclinic_services_categories".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ClinicServices[] $xclinicServices
 */
class ClinicServicesCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xclinic_services_categories';
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
        $categories = self::find()->active()->select(['id', 'name'])->asArray()->all();

        return ArrayHelper::map($categories, 'id', 'name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClinicServices()
    {
        return $this->hasMany(ClinicServices::className(), ['category_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ClinicServicesCategoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClinicServicesCategoriesQuery(get_called_class());
    }
}
