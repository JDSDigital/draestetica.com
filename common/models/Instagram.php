<?php

namespace common\models;

use Yii;
use common\models\AccessCodes;

/**
 * This is the model class for table "xsocial_instagram_images".
 *
 * @property int $id
 * @property string $url
 * @property string $thumbnail
 * @property string $low_resolution
 * @property string $standard_resolution
 * @property string $text
 * @property int $created_time
 * @property int $created_at
 * @property int $updated_at
 */
class Instagram extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xsocial_instagram_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'thumbnail', 'low_resolution', 'standard_resolution', 'text', 'created_time'], 'required'],
            [['created_time', 'created_at', 'updated_at'], 'integer'],
            [['url', 'thumbnail', 'low_resolution', 'standard_resolution', 'text'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'thumbnail' => 'Miniatura',
            'low_resolution' => 'Baja Resolución',
            'standard_resolution' => 'Alta Resolución',
            'text' => 'Texto',
            'created_time' => 'Creado En',
            'created_at' => 'Created At',
            'updated_at' => 'Actualizado En',
        ];
    }

    /*
     * Loads and saves image data from an Instagram array
     */
    public function savePhoto(array $photo): bool
    {
        $this->url = $photo['link'];
        $this->thumbnail = $photo['images']['thumbnail']['url'];
        $this->low_resolution = $photo['images']['low_resolution']['url'];
        $this->standard_resolution = $photo['images']['standard_resolution']['url'];
        $this->text = $photo['caption']['text'];
        $this->created_time = $photo['created_time'];
        $this->created_at = time();
        $this->updated_at = time();

        return ($this->save()) ? true : false;
    }

    /*
     * Gets Instagram data, truncates Instagram table and saves last 5 images to database
     */
    public static function updateInstagramPhotos(): bool
    {
        $photos = self::getInstagramPhotos();
        if ($photos['meta']['code'] == 200) {
            Yii::$app->db->createCommand()->truncateTable(self::tableName())->execute();

            $i = 1;
            foreach ($photos['data'] as $photo) {
                $instagram = new Instagram;
                $instagram->savePhoto($photo);
                if ($i == 5) {
                    break;
                } else {
                  $i++;
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /*
     * Gets an array from Instagram API with images data
     */
    public static function getInstagramPhotos(): array
    {
        $url = self::getApiUrl();
        try {
          	$curl_connection = curl_init($url);
          	curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
          	curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
          	curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);

          	//Data are stored in $data
          	$data = json_decode(curl_exec($curl_connection), true);
          	curl_close($curl_connection);

            return $data;
        } catch(Exception $e) {
        	   return $e->getMessage();
        }
    }

    /*
     * Returns Instagram API URL with access token
     */
    public static function getApiUrl(): string
    {
        $code = AccessCodes::getAccessCode();

        return 'https://api.instagram.com/v1/users/self/media/recent/?access_token=' . $code;
    }

    /*
     * Gets Instagram access token using an access code
     */
    public static function requestAccessToken(string $code): array
    {
        try {
            $curl_connection = curl_init();
            curl_setopt($curl_connection, CURLOPT_URL, 'https://api.instagram.com/oauth/access_token');
            curl_setopt($curl_connection, CURLOPT_POST, 1);
            curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl_connection, CURLOPT_POSTFIELDS, self::requestAccessTokenFields($code));

            //Data are stored in $data
            $data = json_decode(curl_exec($curl_connection), true);
            curl_close($curl_connection);

            return $data;
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    /*
     * Returns a string with necesary data for requesting an access token
     */
    public static function requestAccessTokenFields(string $code): string
    {
        return 'client_id=' . Yii::$app->params['client_id']
        . '&client_secret=' . Yii::$app->params['client_secret']
        . '&grant_type=authorization_code'
        . '&code=' . $code
        . '&redirect_uri=' . Yii::$app->params['redirect_uri'];
    }

    /*
     * Returns Instagram URL for requesting an access code
     */
    public static function getApiAuthUrl(): string
    {
        return 'https://api.instagram.com/oauth/authorize/?client_id=' . Yii::$app->params['client_id'] . '&redirect_uri=' . Yii::$app->params['redirect_uri'] . '&response_type=code';
    }

    /*
     * Returns latest 5 instagram images for Social sidebar
     */
    public static function getLatestPhotos(): array
    {
        return self::find()->orderBy(['created_time' => SORT_DESC])->limit(5)->all();
    }
}
