<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "xsocial_access_codes".
 *
 * @property int $id
 * @property string $access_token
 */
class AccessCodes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xsocial_access_codes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['access_token'], 'required'],
            [['access_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'access_token' => 'Access Token',
        ];
    }

    public static function getAccessCode()
    {
        $code = self::find()->where(['id' => 1])->one();

        return $code->access_token;
    }
}
