<?php

namespace app\models;

/**
 * This is the model class for table "animales_enfermedades".
 *
 * @property int $enfermedad_id
 * @property int $animal_id
 * @property string desde
 * @property string hasta
 *
 * @property Animales $animal
 * @property Enfermedades $enfermedad
 */
class AnimalesEnfermedades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'animales_enfermedades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enfermedad_id', 'animal_id', 'desde'], 'required'],
            [['enfermedad_id', 'animal_id'], 'default', 'value' => null],
            [['enfermedad_id', 'animal_id'], 'integer'],
            [['hasta'], 'safe'],
            [['enfermedad_id', 'animal_id', 'desde'], 'unique', 'targetAttribute' => ['enfermedad_id', 'animal_id', 'desde']],
            [['animal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Animales::className(), 'targetAttribute' => ['animal_id' => 'id']],
            [['enfermedad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Enfermedades::className(), 'targetAttribute' => ['enfermedad_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'enfermedad_id' => 'Enfermedad',
            'animal_id' => 'Animal ID',
            'desde' => 'Desde',
            'hasta' => 'Hasta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimal()
    {
        return $this->hasOne(Animales::className(), ['id' => 'animal_id'])->inverseOf('animalesEnfermedades');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnfermedad()
    {
        return $this->hasOne(Enfermedades::className(), ['id' => 'enfermedad_id'])->inverseOf('animalesEnfermedades');
    }
}
