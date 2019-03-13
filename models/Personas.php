<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personas".
 *
 * @property int $id
 * @property string $nombre
 * @property string $primer_apellido
 * @property string $segundo_apellido
 * @property string $direccion
 * @property string $telefono
 * @property string $email
 * @property string $observaciones
 *
 * @property Acogidas[] $acogidas
 */
class Personas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['observaciones'], 'string'],
            [['nombre', 'primer_apellido', 'segundo_apellido', 'direccion', 'telefono', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'primer_apellido' => 'Primer Apellido',
            'segundo_apellido' => 'Segundo Apellido',
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
            'email' => 'Email',
            'observaciones' => 'Observaciones',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcogidas()
    {
        return $this->hasMany(Acogidas::className(), ['persona_id' => 'id'])->inverseOf('persona');
    }
}
