<?php

namespace app\models;

/**
 * This is the model class for table "animales_razas".
 *
 * @property int $animal_id
 * @property int $raza_id
 *
 * @property Animales $animal
 * @property Razas $raza
 */
class AnimalesRazas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'animales_razas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['animal_id', 'raza_id'], 'required'],
            [['animal_id', 'raza_id'], 'default', 'value' => null],
            [['animal_id', 'raza_id'], 'integer'],
            [['animal_id', 'raza_id'], 'unique', 'targetAttribute' => ['animal_id', 'raza_id']],
            [['animal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Animales::className(), 'targetAttribute' => ['animal_id' => 'id']],
            [['raza_id'], 'exist', 'skipOnError' => true, 'targetClass' => Razas::className(), 'targetAttribute' => ['raza_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'animal_id' => 'Animal ID',
            'raza_id' => 'Raza ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimal()
    {
        return $this->hasOne(Animales::className(), ['id' => 'animal_id'])->inverseOf('animalesRazas');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaza()
    {
        return $this->hasOne(Razas::className(), ['id' => 'raza_id'])->inverseOf('animalesRazas');
    }
}
