<?php

namespace app\models;

/**
 * This is the model class for table "vacunas".
 *
 * @property int $id
 * @property string $vacuna
 * @property int $dosis
 * @property string $entre_dosis
 * @property string $periodicidad
 * @property string $observaciones
 *
 * @property Vacunaciones[] $vacunaciones
 * @property Enfermedades[] $vacunas
 */
class Vacunas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vacunas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vacuna'], 'required'],
            [['dosis'], 'default', 'value' => null],
            [['dosis'], 'integer'],
            [['entre_dosis', 'periodicidad', 'observaciones'], 'string'],
            [['vacuna'], 'string', 'max' => 255],
            [['vacuna'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vacuna' => 'Vacuna',
            'dosis' => 'Dosis',
            'entre_dosis' => 'Entre Dosis',
            'periodicidad' => 'Periodicidad',
            'observaciones' => 'Observaciones',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacunaciones()
    {
        return $this->hasMany(Vacunaciones::className(), ['animal_id' => 'id'])->inverseOf('animal');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacunas()
    {
        return $this->hasMany(Enfermedades::className(), ['id' => 'vacuna_id'])->viaTable('vacunaciones', ['animal_id' => 'id']);
    }

    public static function todas()
    {
        return static::find()->select('vacuna')->orderBy('vacuna')->indexBy('id')->column();
    }
}
