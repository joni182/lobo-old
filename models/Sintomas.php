<?php

namespace app\models;

/**
 * This is the model class for table "sintomas".
 *
 * @property int $id
 * @property string $sintoma
 * @property string $descripcion
 *
 * @property EnfermedadesSintomas[] $enfermedadesSintomas
 * @property Enfermedades[] $enfermedads
 */
class Sintomas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sintomas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sintoma'], 'required'],
            [['sintoma'], 'trim'],
            [['sintoma'], 'filter', 'filter' => 'strtolower'],
            [['sintoma'], 'filter', 'filter' => function ($value) {
                return str_replace('.', '', $value);
            }],
            [['descripcion'], 'string'],
            [['sintoma'], 'string', 'max' => 255],
            [['sintoma'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sintoma' => 'Sintoma',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnfermedadesSintomas()
    {
        return $this->hasMany(EnfermedadesSintomas::className(), ['sintoma_id' => 'id'])->inverseOf('sintoma');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnfermedads()
    {
        return $this->hasMany(Enfermedades::className(), ['id' => 'enfermedad_id'])->viaTable('enfermedades_sintomas', ['sintoma_id' => 'id']);
    }

    /**
     * Devuelve todas los sintomas indexados por su id
     * @return array nombre de sintomas indexados por su id
     */

    public static function todos()
    {
        return static::find()
            ->select('sintoma')
            //->indexBy('id')
            ->column();
    }
}
