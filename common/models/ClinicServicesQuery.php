<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ClinicServices]].
 *
 * @see ClinicServices
 */
class ClinicServicesQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]=1');
    }

    /**
     * {@inheritdoc}
     * @return ClinicServices[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ClinicServices|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
