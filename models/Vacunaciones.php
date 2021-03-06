<?php

namespace app\models;

/**
 * This is the model class for table "vacunaciones".
 *
 * @property int $vacuna_id
 * @property int $animal_id
 * @property string $fecha
 *
 * @property Enfermedades $vacuna
 * @property Vacunas $animal
 */
class Vacunaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vacunaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vacuna_id', 'animal_id'], 'required'],
            [['vacuna_id', 'animal_id'], 'default', 'value' => null],
            [['vacuna_id', 'animal_id'], 'integer'],
            [['fecha'], 'safe'],
            [['vacuna_id', 'animal_id', 'fecha'], 'unique', 'targetAttribute' => ['vacuna_id', 'animal_id', 'fecha']],
            [['vacuna_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vacunas::className(), 'targetAttribute' => ['vacuna_id' => 'id']],
            [['animal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Animales::className(), 'targetAttribute' => ['animal_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vacuna_id' => 'Vacuna',
            'animal_id' => 'Animal ID',
            'fecha' => 'Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacuna()
    {
        return $this->hasOne(Vacunas::className(), ['id' => 'vacuna_id'])->inverseOf('vacunaciones');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimal()
    {
        return $this->hasOne(Animales::className(), ['id' => 'animal_id'])->inverseOf('vacunaciones');
    }
}
