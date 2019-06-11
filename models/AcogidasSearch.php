<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AcogidasSearch represents the model behind the search form of `\app\models\Acogidas`.
 */
class AcogidasSearch extends Acogidas
{
    /**
     * limite inferior del rango de fechas a buscar
     * @var string
     */
    public $desde;
    /**
    * limite superior del rango de fechas a buscar
    * @var string
    */
    public $hasta;
    /**
     * Id del animal adoptado por el que se va a buscar
     * @var int
     */
    public $animal;
    /**
    * Id de la persona adoptadora por el que se va a buscar
    * @var int
    */
    public $persona;
    /**
     * Id de la especie por la que se va a buscar
     * @var [type]
     */
    public $grupo;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tipo_id', 'animal_id', 'persona_id', 'grupo'], 'integer'],
            [['precio'], 'number'],
            [['fecha', 'duracion', 'observaciones', 'desde', 'hasta', 'animal', 'persona'], 'safe'],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), ['desde', 'hasta', 'animal', 'persona', 'grupo']);
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
     * Creates data provider instance with search query applied.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Acogidas::find()->joinWith('persona', 'acogidas.persona_id = personas.id')->joinWith('animal', 'acogidas.animal_id = animales.id');

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
            'precio' => $this->precio,
            'fecha' => $this->fecha,
            'tipo_id' => $this->tipo_id,
            'animal_id' => $this->animal_id,
            'persona_id' => $this->persona_id,
            'animales.especie_id' => $this->grupo,
        ]);

        if (($flip = $this->desde) > $this->hasta) {
            $this->desde = $this->hasta;
            $this->hasta = $flip;
        }

        $query->andFilterWhere(['ilike', 'duracion', $this->duracion])
            ->orFilterWhere(['ilike', 'personas.nombre', $this->persona])
            ->orFilterWhere(['ilike', 'personas.primer_apellido', $this->persona])
            ->orFilterWhere(['ilike', 'personas.segundo_apellido', $this->persona])
            ->andFilterWhere(['between', 'fecha', $this->desde, $this->hasta])
            ->andFilterWhere(['ilike', 'observaciones', $this->observaciones]);




        return $dataProvider;
    }
}
