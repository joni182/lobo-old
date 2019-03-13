<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "enfermedades".
 *
 * @property int $id
 * @property string $enfermedad
 * @property string $descripcion
 *
 * @property AnimalesEnfermedades[] $animalesEnfermedades
 * @property EnfermedadesSintomas[] $enfermedadesSintomas
 * @property Sintomas[] $sintomas
 */
class Enfermedades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enfermedades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enfermedad'], 'required'],
            [['descripcion'], 'string'],
            [['enfermedad'], 'string', 'max' => 255],
            [['enfermedad'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'enfermedad' => 'Enfermedad',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalesEnfermedades()
    {
        return $this->hasMany(AnimalesEnfermedades::className(), ['enfermedad_id' => 'id'])->inverseOf('enfermedad');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnfermedadesSintomas()
    {
        return $this->hasMany(EnfermedadesSintomas::className(), ['enfermedad_id' => 'id'])->inverseOf('enfermedad');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSintomas()
    {
        return $this->hasMany(Sintomas::className(), ['id' => 'sintoma_id'])->viaTable('enfermedades_sintomas', ['enfermedad_id' => 'id']);
    }
}
