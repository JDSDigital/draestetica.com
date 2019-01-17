<?php

namespace common\models;

use Yii;

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
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xpartners_logos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'url', 'file', 'created_at', 'updated_at'], 'required'],
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
            'status' => 'Status',
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
}
