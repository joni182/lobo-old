<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipos".
 *
 * @property int $id
 * @property string $tipo
 *
 * @property Acogidas[] $acogidas
 */
class Tipos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
            [['tipo'], 'string', 'max' => 255],
            [['tipo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcogidas()
    {
        return $this->hasMany(Acogidas::className(), ['tipo_id' => 'id'])->inverseOf('tipo');
    }
}
