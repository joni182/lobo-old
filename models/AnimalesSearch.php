<?php

namespace app\models;

use DateTime;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AnimalesSearch represents the model behind the search form of `\app\models\Animales`.
 */
class AnimalesSearch extends Animales
{
    public $nacimiento_desde;
    public $nacimiento_hasta;
    public $peso_desde;
    public $peso_hasta;
    public $especie;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nombre', 'nacimiento', 'nacimiento_desde', 'nacimiento_hasta', 'chip', 'sexo', 'observaciones', 'created_at', 'updated_at'], 'safe'],
            [['peso', 'peso_desde', 'peso_hasta', 'especie'], 'number'],
            //[['ppp', 'esterilizado'], 'boolean'],
            [['ppp', 'esterilizado'], 'default', 'value' => null],
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

    public function attributes()
    {
        return array_merge(parent::attributes(), ['peso_desde', 'peso_hasta', 'nacimiento_desde', 'nacimiento_hasta', 'especie']);
    }

    /**
     * Creates data provider instance with search query applied.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Animales::find()->joinWith('razas')->joinWith('especie');

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
            'nacimiento' => $this->nacimiento,
            'peso' => $this->peso,
            'ppp' => $this->ppp,
            'esterilizado' => $this->esterilizado,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        // if ($this->ppp !== '') {
        //     $query->andFilterWhere(['ppp' => $this->ppp]);
        // }
        //
        // if ($this->esterilizado !== '') {
        //     $query->andFilterWhere(['esterilizado' => $this->esterilizado]);
        // }

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'chip', $this->chip])
            ->andFilterWhere(['=', 'especies.id', $this->especie])
            ->andFilterWhere(['ilike', 'sexo', $this->sexo])
            ->andFilterWhere(['ilike', 'observaciones', $this->observaciones])
            ->andFilterWhere([
                'between',
                'peso',
                $this->peso_desde == null ? 0 : $this->peso_desde,
                $this->peso_hasta == null ? 9999 : $this->peso_hasta,
            ])
            ->andFilterWhere([
                'between',
                'nacimiento',
                $this->nacimiento_desde == null ? (new DateTime('0001-01-01'))->format('Y-m-d') : $this->nacimiento_desde,
                $this->nacimiento_hasta == null ? (new DateTime('9999-11-31'))->format('Y-m-d') : $this->nacimiento_hasta,
            ]);

        // dd($this);
        return $dataProvider;
    }
}
