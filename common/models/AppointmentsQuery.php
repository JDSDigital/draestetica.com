<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Appointments]].
 *
 * @see Appointments
 */
class AppointmentsQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]=1');
    }

    public function byDateRange($startDate, $finalDate): self
    {
        return $this->andWhere(['between', 'date', $startDate, $finalDate]);
    }

    public function byMonth(string $date): self
    {
        return $this->andWhere(['like', 'date', substr($date, 0, 7)])
            ->orderBy(['date' => SORT_ASC]);
    }

    public function byDay(string $date): self
    {
        return $this->andWhere(['like', 'date', substr($date, 0, 10)])
            ->orderBy(['date' => SORT_ASC]);
    }

    /**
     * {@inheritdoc}
     * @return Appointments[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Appointments|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
