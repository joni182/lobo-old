<?php

namespace app\models;

/**
 * This is the model class for table "roles".
 *
 * @property int $id
 * @property string $nombre
 */
class Roles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * Devuelve todas los roles indexados por su id
     * @return array nombre de roles indexados por su id
     */

    public static function todas()
    {
        return static::find()->select('nombre')->indexBy('id')->column();
    }
}
