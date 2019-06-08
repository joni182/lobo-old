<?php

namespace app\models;

/**
 * This is the model class for table "tratamientos".
 *
 * @property int $id
 * @property int $medicamento_id
 * @property int $animal_id
 * @property string $inicio
 * @property string $duracion
 * @property string $dosis
 * @property int $veces_por_dia
 * @property string $observaciones
 *
 * @property Animales $animal
 * @property Medicamentos $medicamento
 */
class Tratamientos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tratamientos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
             [['medicamento_id', 'animal_id', 'inicio'], 'required'],
             [['medicamento_id', 'animal_id', 'veces_por_dia', 'duracion'], 'default', 'value' => null],
             [['medicamento_id', 'animal_id', 'veces_por_dia'], 'integer'],
             [['duracion', 'observaciones'], 'string'],
             [['dosis'], 'string', 'max' => 255],
             [['medicamento_id', 'animal_id', 'inicio'], 'unique', 'targetAttribute' => ['medicamento_id', 'animal_id', 'inicio']],
             [['animal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Animales::className(), 'targetAttribute' => ['animal_id' => 'id']],
             [['medicamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medicamentos::className(), 'targetAttribute' => ['medicamento_id' => 'id']],
         ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'medicamento_id' => 'Medicamento',
            'animal_id' => 'Animal ID',
            'inicio' => 'Inicio',
            'duracion' => 'Duración',
            'dosis' => 'Dosis',
            'veces_por_dia' => 'Pauta',
            'observaciones' => 'Observaciones',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimal()
    {
        return $this->hasOne(Animales::className(), ['id' => 'animal_id'])->inverseOf('tratamientos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedicamento()
    {
        return $this->hasOne(Medicamentos::className(), ['id' => 'medicamento_id'])->inverseOf('tratamientos');
    }
}
