<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\Tags;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * This is the model class for table "xblog_articles".
 *
 * @property int $id
 * @property int $tag_id
 * @property string $title
 * @property string $summary
 * @property string $article
 * @property string $file
 * @property string $author
 * @property string $source
 * @property int $views
 * @property int $featured
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Blog extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    public $image;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xblog_articles';
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
            [['tag_id', 'views', 'featured', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'summary', 'file'], 'required'],
            [['article'], 'string'],
            [['title', 'summary', 'file', 'author', 'source'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag_id' => 'Tag',
            'title' => 'Título',
            'summary' => 'Resumen',
            'article' => 'Artículo',
            'file' => 'Imágen',
            'author' => 'Autor',
            'source' => 'Fuente',
            'views' => 'Vistas',
            'featured' => 'Destacado',
            'status' => 'Estado',
            'created_at' => 'Creado En',
            'updated_at' => 'Modificado En',
        ];
    }

    public static function getImagefolder()
    {
        return Yii::getAlias('@frontend/web/img/blog/');
    }

    public static function getFolder()
    {
        $directory = Yii::getAlias('@web/img/blog/');

        return str_replace('admin/', '', $directory);
    }

    public function getLogo()
    {
        return self::getFolder() . $this->file;
    }

    public function getRelated()
    {
        return self::find()->active()->where(['tag_id' => $this->tag_id])->limit(6)->all();
    }

    /**
     * Upload supplied images via UploadedFile
     * @return boolean
     */
    public function upload()
    {
        $uploadedImage = UploadedFile::getInstances($this, 'image');

        if (count($uploadedImage) > 0) {

            $name = $this->id . '_' .strtolower(str_replace(' ', '-', $this->title)) . '.' . $uploadedImage[0]->extension;

            $this->file = $name;

            $uploadedImage[0]->saveAs(self::getImagefolder() . 'tmp-' . $name);

            Image::resize(self::getImagefolder() . 'tmp-' . $name, 1024, null)
            ->save(self::getImagefolder() . $name, ['jpeg_quality' => 80]);

            unlink(self::getImagefolder() . 'tmp-' . $name);

            return true;
        }

        return false;

    }

    public function deleteImage()
    {
        $image = $this->getImagefolder() . $this->file;

        return (unlink($image)) ? true : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tags::className(), ['id' => 'tag_id']);
    }

    /**
     * {@inheritdoc}
     * @return BlogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BlogQuery(get_called_class());
    }
}
