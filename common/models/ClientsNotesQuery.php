<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ClientsNotes]].
 *
 * @see ClientsNotes
 */
class ClientsNotesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ClientsNotes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ClientsNotes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
