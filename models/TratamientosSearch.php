<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tratamientos;

/**
 * TratamientosSearch represents the model behind the search form of `\app\models\Tratamientos`.
 */
class TratamientosSearch extends Tratamientos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'medicamento_id', 'animal_id', 'veces_por_dia'], 'integer'],
            [['inicio', 'duracion', 'dosis', 'observaciones'], 'safe'],
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
        $query = Tratamientos::find();

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
            'medicamento_id' => $this->medicamento_id,
            'animal_id' => $this->animal_id,
            'inicio' => $this->inicio,
            'veces_por_dia' => $this->veces_por_dia,
        ]);

        $query->andFilterWhere(['ilike', 'duracion', $this->duracion])
            ->andFilterWhere(['ilike', 'dosis', $this->dosis])
            ->andFilterWhere(['ilike', 'observaciones', $this->observaciones]);

        return $dataProvider;
    }
}
