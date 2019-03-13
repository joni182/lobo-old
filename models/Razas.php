<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "razas".
 *
 * @property int $id
 * @property string $raza
 * @property int $especie_id
 *
 * @property AnimalesRazas[] $animalesRazas
 * @property Animales[] $animals
 * @property Especies $especie
 */
class Razas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'razas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['raza', 'especie_id'], 'required'],
            [['especie_id'], 'default', 'value' => null],
            [['especie_id'], 'integer'],
            [['raza'], 'string', 'max' => 255],
            [['raza', 'especie_id'], 'unique', 'targetAttribute' => ['raza', 'especie_id']],
            [['raza'], 'unique'],
            [['especie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Especies::className(), 'targetAttribute' => ['especie_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'raza' => 'Raza',
            'especie_id' => 'Especie ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalesRazas()
    {
        return $this->hasMany(AnimalesRazas::className(), ['raza_id' => 'id'])->inverseOf('raza');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimals()
    {
        return $this->hasMany(Animales::className(), ['id' => 'animal_id'])->viaTable('animales_razas', ['raza_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEspecie()
    {
        return $this->hasOne(Especies::className(), ['id' => 'especie_id'])->inverseOf('razas');
    }
}
