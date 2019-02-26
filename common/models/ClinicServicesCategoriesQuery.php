<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ClinicServicesCategories]].
 *
 * @see ClinicServicesCategories
 */
class ClinicServicesCategoriesQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]=1');
    }

    /**
     * {@inheritdoc}
     * @return ClinicServicesCategories[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ClinicServicesCategories|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
