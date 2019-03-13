<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "especies".
 *
 * @property int $id
 * @property string $especie
 *
 * @property Razas[] $razas
 */
class Especies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'especies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['especie'], 'required'],
            [['especie'], 'string', 'max' => 255],
            [['especie'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'especie' => 'Especie',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRazas()
    {
        return $this->hasMany(Razas::className(), ['especie_id' => 'id'])->inverseOf('especie');
    }
}
