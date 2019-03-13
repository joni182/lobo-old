<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "enfermedades_sintomas".
 *
 * @property int $enfermedad_id
 * @property int $sintoma_id
 *
 * @property Enfermedades $enfermedad
 * @property Sintomas $sintoma
 */
class EnfermedadesSintomas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enfermedades_sintomas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enfermedad_id', 'sintoma_id'], 'required'],
            [['enfermedad_id', 'sintoma_id'], 'default', 'value' => null],
            [['enfermedad_id', 'sintoma_id'], 'integer'],
            [['enfermedad_id', 'sintoma_id'], 'unique', 'targetAttribute' => ['enfermedad_id', 'sintoma_id']],
            [['enfermedad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Enfermedades::className(), 'targetAttribute' => ['enfermedad_id' => 'id']],
            [['sintoma_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sintomas::className(), 'targetAttribute' => ['sintoma_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'enfermedad_id' => 'Enfermedad ID',
            'sintoma_id' => 'Sintoma ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnfermedad()
    {
        return $this->hasOne(Enfermedades::className(), ['id' => 'enfermedad_id'])->inverseOf('enfermedadesSintomas');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSintoma()
    {
        return $this->hasOne(Sintomas::className(), ['id' => 'sintoma_id'])->inverseOf('enfermedadesSintomas');
    }
}
