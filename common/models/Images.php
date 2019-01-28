<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
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

    public function beforeSave($insert)
    {
        return true;
  	}

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['uploaded_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['uploaded_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
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
