<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UsuariosInfoSearch represents the model behind the search form of `\app\models\UsuariosInfo`.
 */
class UsuariosInfoSearch extends UsuariosInfo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'usuario_id'], 'integer'],
            [['nombre', 'primer_apellido', 'segundo_apellido', 'login', 'password', 'email', 'access_token', 'validate_token', 'validated_at', 'rol_id'], 'safe'],
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
     * Creates data provider instance with search query applied.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = UsuariosInfo::find()->leftJoin('roles', 'usuarios_info.rol_id = roles.id');

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
            'usuario_id' => $this->usuario_id,
            'validated_at' => $this->validated_at,
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'primer_apellido', $this->primer_apellido])
            ->andFilterWhere(['ilike', 'segundo_apellido', $this->segundo_apellido])
            ->andFilterWhere(['ilike', 'login', $this->login])
            ->andFilterWhere(['ilike', 'password', $this->password])
            ->andFilterWhere(['ilike', 'email', $this->email])
            ->andFilterWhere(['ilike', 'access_token', $this->access_token])
            ->andFilterWhere(['ilike', 'roles.nombre', $this->rol_id])
            ->andFilterWhere(['ilike', 'validate_token', $this->validate_token]);

        return $dataProvider;
    }
}
