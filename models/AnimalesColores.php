<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "animales_colores".
 *
 * @property int $animal_id
 * @property int $color_id
 *
 * @property Animales $animal
 * @property Colores $color
 */
class AnimalesColores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'animales_colores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['animal_id', 'color_id'], 'required'],
            [['animal_id', 'color_id'], 'default', 'value' => null],
            [['animal_id', 'color_id'], 'integer'],
            [['animal_id', 'color_id'], 'unique', 'targetAttribute' => ['animal_id', 'color_id']],
            [['animal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Animales::className(), 'targetAttribute' => ['animal_id' => 'id']],
            [['color_id'], 'exist', 'skipOnError' => true, 'targetClass' => Colores::className(), 'targetAttribute' => ['color_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'animal_id' => 'Animal ID',
            'color_id' => 'Color ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimal()
    {
        return $this->hasOne(Animales::className(), ['id' => 'animal_id'])->inverseOf('animalesColores');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(Colores::className(), ['id' => 'color_id'])->inverseOf('animalesColores');
    }
}
