<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\BaseActiveRecord;

/**
 * This is the model class for table "xclinic_appointments".
 *
 * @property int $id
 * @property int $client_id
 * @property int $service_id
 * @property int $date
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Clients $client
 * @property ClinicServices $service
 */
class Appointments extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xclinic_appointments';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'service_id', 'status'], 'integer'],
            [['date'], 'safe'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClinicServices::className(), 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'client_id' => 'Service ID',
            'date' => 'Date',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(ClinicServices::className(), ['id' => 'service_id']);
    }

    /**
     * {@inheritdoc}
     * @return AppointmentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppointmentsQuery(get_called_class());
    }

    public static function getBookedHoursByDate(string $date): array
    {
        $bookedHours = [];
        $appointments = self::find()
            ->byDay($date)
            ->all();

        foreach ($appointments as $key => $value) {
            array_push($bookedHours, substr($value, 11, 2));
        }

        return $bookedHours;
    }
}
