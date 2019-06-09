<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vacunas;

/**
 * VacunasSearch represents the model behind the search form of `\app\models\Vacunas`.
 */
class VacunasSearch extends Vacunas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'dosis'], 'integer'],
            [['vacuna', 'entre_dosis', 'periodicidad', 'observaciones'], 'safe'],
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
        $query = Vacunas::find();

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
            'dosis' => $this->dosis,
        ]);

        $query->andFilterWhere(['ilike', 'vacuna', $this->vacuna])
            ->andFilterWhere(['ilike', 'entre_dosis', $this->entre_dosis])
            ->andFilterWhere(['ilike', 'periodicidad', $this->periodicidad])
            ->andFilterWhere(['ilike', 'observaciones', $this->observaciones]);

        return $dataProvider;
    }
}
