<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\Tags;
use common\models\Authors;
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
 * @property string $instagram
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

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->source != null && $this->source != '' && substr( $this->source, 0, 4 ) != "http") {
            $this->source = 'https://' . $this->source;
        }

        if ($this->instagram != null && $this->instagram != '' && substr( $this->instagram, 0, 4 ) != "http") {
            $this->instagram = 'https://' . $this->instagram;
        }

        return true;
  	}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tag_id', 'author_id', 'views', 'featured', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'summary'], 'required'],
            [['article'], 'string'],
            [['title', 'summary', 'file', 'source', 'instagram'], 'string', 'max' => 255],
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
            'author_id' => 'Autor',
            'title' => 'Título',
            'summary' => 'Resumen',
            'article' => 'Artículo',
            'file' => 'Imágen',
            'source' => 'Fuente',
            'instagram' => 'Instagram',
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

    public static function getImagethumbfolder()
    {
        return Yii::getAlias('@frontend/web/img/blog/thumbs/');
    }

    public static function getFolder()
    {
        $directory = Yii::getAlias('@web/img/blog/');

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

    public function getRelated()
    {
        return self::find()->active()->where(['tag_id' => $this->tag_id])->limit(6)->all();
    }

    public static function getLatest()
    {
        return self::find()->active()->orderBy(['created_at' => SORT_DESC])->limit(4)->all();
    }

    /**
     * Upload supplied images via UploadedFile
     * @return boolean
     */
    public function upload(): bool
    {
        $uploadedImage = UploadedFile::getInstances($this, 'image');

        if (count($uploadedImage) > 0) {

            $name = $this->id . '_' .strtolower(str_replace(' ', '-', $this->title)) . '.' . $uploadedImage[0]->extension;

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

        Image::resize(self::getImagefolder() . 'tmp-' . $name, 250, null)
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

    public function getInstagramName()
    {
        $instagram = trim($this->instagram, "/");
        $parts = explode("/", $instagram);

        return '@' . $parts[count($parts) - 1];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tags::className(), ['id' => 'tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
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
