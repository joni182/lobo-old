<?php

namespace app\models;

/**
 * This is the model class for table "colores".
 *
 * @property int $id
 * @property string $nombre
 * @property string $color
 *
 * @property AnimalesColores[] $animalesColores
 * @property Animales[] $animals
 */
class Colores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'colores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color'], 'required'],
            [['nombre'], 'string', 'max' => 255],
            [['color'], 'string', 'max' => 7],
            [['color'], 'unique'],
            [['nombre'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'color' => 'Color',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalesColores()
    {
        return $this->hasMany(AnimalesColores::className(), ['color_id' => 'id'])->inverseOf('color');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimals()
    {
        return $this->hasMany(Animales::className(), ['id' => 'animal_id'])->viaTable('animales_colores', ['color_id' => 'id']);
    }
}
