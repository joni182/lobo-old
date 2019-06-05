<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AnimalesEnfermedades;

/**
 * AnimalesEnfermedadesSearch represents the model behind the search form of `\app\models\AnimalesEnfermedades`.
 */
class AnimalesEnfermedadesSearch extends AnimalesEnfermedades
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enfermedad_id', 'animal_id'], 'integer'],
            [['desde', 'hasta'], 'safe'],
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
        $query = AnimalesEnfermedades::find();

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
            'enfermedad_id' => $this->enfermedad_id,
            'animal_id' => $this->animal_id,
            'desde' => $this->desde,
            'hasta' => $this->hasta,
        ]);

        return $dataProvider;
    }
}
