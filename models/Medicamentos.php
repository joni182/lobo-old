<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medicamentos".
 *
 * @property int $id
 * @property string $medicamento
 * @property string $descripcion
 * @property string $principio
 *
 * @property Tratamientos[] $tratamientos
 * @property Animales[] $animals
 */
class Medicamentos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medicamentos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['medicamento'], 'required'],
            [['descripcion'], 'string'],
            [['medicamento', 'principio'], 'string', 'max' => 255],
            [['medicamento'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'medicamento' => 'Medicamento',
            'descripcion' => 'Descripcion',
            'principio' => 'Principio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTratamientos()
    {
        return $this->hasMany(Tratamientos::className(), ['medicamento_id' => 'id'])->inverseOf('medicamento');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimals()
    {
        return $this->hasMany(Animales::className(), ['id' => 'animal_id'])->viaTable('tratamientos', ['medicamento_id' => 'id']);
    }
}