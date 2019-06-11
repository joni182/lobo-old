<?php

namespace app\models;

/**
 * This is the model class for table "acogidas".
 *
 * @property int $id
 * @property string $precio
 * @property string $fecha
 * @property string $duracion
 * @property string $observaciones
 * @property int $tipo_id
 * @property int $animal_id
 * @property int $persona_id
 *
 * @property Animales $animal
 * @property Personas $persona
 * @property Tipos $tipo
 */
class Acogidas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acogidas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['precio'], 'number'],
            [['fecha'], 'safe'],
            [['duracion', 'observaciones'], 'string'],
            [['tipo_id', 'animal_id', 'persona_id'], 'required'],
            [['tipo_id', 'animal_id', 'persona_id'], 'default', 'value' => null],
            [['tipo_id', 'animal_id', 'persona_id'], 'integer'],
            [['animal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Animales::className(), 'targetAttribute' => ['animal_id' => 'id']],
            [['persona_id'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['persona_id' => 'id']],
            [['tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipos::className(), 'targetAttribute' => ['tipo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'precio' => 'Precio',
            'fecha' => 'Fecha',
            'duracion' => 'Duracion',
            'observaciones' => 'Observaciones',
            'tipo_id' => 'Tipo ID',
            'animal_id' => 'Animal ID',
            'persona_id' => 'Persona ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimal()
    {
        return $this->hasOne(Animales::className(), ['id' => 'animal_id'])->inverseOf('acogidas');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Personas::className(), ['id' => 'persona_id'])->inverseOf('acogidas');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(Tipos::className(), ['id' => 'tipo_id'])->inverseOf('acogidas');
    }
}
