<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use common\models\Images;

/**
 * This is the model class for table "xsocial_articles".
 *
 * @property int $id
 * @property string $title
 * @property string $summary
 * @property string $article
 * @property string $source
 * @property int $views
 * @property int $featured
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Social extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xsocial_articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'summary'], 'required'],
            [['article'], 'string'],
            [['views', 'featured', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'summary', 'source'], 'string', 'max' => 255],
        ];
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Título',
            'summary' => 'Resumen',
            'article' => 'Artículo',
            'source' => 'Fuente',
            'views' => 'Vistas',
            'featured' => 'Destacado',
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
                    $image = new Images;
                    $name = $this->id . '-' . ($key + 1) . '-' . time() . '.' . $uploadedImage->extension;

                    $image->file = $name;
                    $image->article_id = $this->id;

                    if (!$image->saveImages($uploadedImage, $name)) {
                        return false;
                    }

                    if ($key == 0) {
                        $image->cover = (!$this->cover) ? Images::STATUS_ACTIVE : Images::STATUS_DELETED;
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

    public function getRelated(): array
    {
        return self::find()->active()->orderBy(['created_at' => SORT_DESC])->limit(6)->all();
    }

    public static function getFooterPosts(): array
    {
        return self::find()->active()->orderBy(['created_at' => SORT_DESC])->limit(2)->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCover()
    {
        $cover = $this->hasOne(Images::className(), ['article_id' => 'id'])
            ->andOnCondition(['cover' => Images::STATUS_ACTIVE]);

        return ($cover->one()) ? $cover : $this->hasOne(Images::className(), ['article_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Images::className(), ['article_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return SocialQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SocialQuery(get_called_class());
    }
}
