<?php

namespace common\models\search;

use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ClinicServices;
use common\models\ClinicServicesCategories;
use common\models\ClinicServicesSubcategories;

/**
 * ClinicServicesSearch represents the model behind the search form of `common\models\ClinicServices`.
 */
class ClinicServicesSearch extends ClinicServices
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'subcategory_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'summary', 'description', 'file'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ClinicServices::find();

        if (Yii::$app->id == 'app-frontend') {
            $query->active()->orderBy(['category_id' => SORT_ASC, 'subcategory_id' => SORT_ASC]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'subcategory_id' => $this->subcategory_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }

    public function frontendServices(array $response = []): array
    {
        $categories = ClinicServicesCategories::find()->active()->select(['id', 'name'])->all();
        $subcategories = ClinicServicesSubcategories::find()->active()->select(['id', 'name'])->all();

        foreach ($categories as $category) {
            foreach ($subcategories as $subcategory) {
                $services = ClinicServices::find()
                ->where(['category_id' => $category->id])
                ->andWhere(['subcategory_id' => $subcategory->id])
                ->active()
                ->all();
                $response[$category->name . ' ' . $subcategory->name] = $services;
            }
        }

        return $response;
    }
}
