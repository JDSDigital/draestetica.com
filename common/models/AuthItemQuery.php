<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[AuthItem]].
 *
 * @see AuthItem
 */
class AuthItemQuery extends \yii\db\ActiveQuery
{
    public function roles()
    {
        return $this->andWhere('[[type]]=1');
    }

    /**
     * {@inheritdoc}
     * @return AuthItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AuthItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
