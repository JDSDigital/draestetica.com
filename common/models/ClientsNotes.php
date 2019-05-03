<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "xclinic_clients_notes".
 *
 * @property int $id
 * @property int $client_id
 * @property string $note
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Clients $client
 */
class ClientsNotes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xclinic_clients_notes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'created_at', 'updated_at'], 'integer'],
            [['note'], 'required'],
            [['note'], 'string'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client_id' => 'id']],
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
            'note' => 'Note',
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
     * {@inheritdoc}
     * @return ClientsNotesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClientsNotesQuery(get_called_class());
    }
}
