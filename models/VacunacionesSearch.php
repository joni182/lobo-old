<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vacunaciones;

/**
 * VacunacionesSearch represents the model behind the search form of `\app\models\Vacunaciones`.
 */
class VacunacionesSearch extends Vacunaciones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vacuna_id', 'animal_id'], 'integer'],
            [['fecha'], 'safe'],
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
        $query = Vacunaciones::find();

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
            'vacuna_id' => $this->vacuna_id,
            'animal_id' => $this->animal_id,
            'fecha' => $this->fecha,
        ]);

        return $dataProvider;
    }
}
