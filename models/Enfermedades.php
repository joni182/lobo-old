<?php

namespace app\models;

/**
 * This is the model class for table "enfermedades".
 *
 * @property int $id
 * @property string $enfermedad
 * @property string $descripcion
 *
 * @property AnimalesEnfermedades[] $animalesEnfermedades
 * @property EnfermedadesSintomas[] $enfermedadesSintomas
 * @property Sintomas[] $sintomas
 */
class Enfermedades extends \yii\db\ActiveRecord
{
    public $sintomasQueNoTengo;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enfermedades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enfermedad'], 'required'],
            [['sintomasQueNoTengo'], 'safe'],
            [['descripcion'], 'string'],
            [['enfermedad'], 'string', 'max' => 255],
            [['enfermedad'], 'unique'],
        ];
    }

    public function attributas()
    {
        return array_merge([parent::attributes(), ['sintomasQueNoTengo']]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'enfermedad' => 'Enfermedad',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalesEnfermedades()
    {
        return $this->hasMany(AnimalesEnfermedades::className(), ['enfermedad_id' => 'id'])->inverseOf('enfermedad');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnfermedadesSintomas()
    {
        return $this->hasMany(EnfermedadesSintomas::className(), ['enfermedad_id' => 'id'])->inverseOf('enfermedad');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSintomas()
    {
        return $this->hasMany(Sintomas::className(), ['id' => 'sintoma_id'])->viaTable('enfermedades_sintomas', ['enfermedad_id' => 'id']);
    }

    public static function todas()
    {
        return static::find()->select('enfermedad')->indexBy('id')->column();
    }

    public function getSintomasQueNoTengo()
    {
        // if (!isset($this->sintomasQueNoTengo)) {
        //     return $this->sintomasQueNoTengo;
        // }
        $sql = <<<'EOT'
select *
  from sintomas
except
select sintomas.*
  from sintomas
  join enfermedades_sintomas
    on sintomas.id = enfermedades_sintomas.sintoma_id
 where enfermedades_sintomas.enfermedad_id = :enfermedad_id
EOT;
        return Sintomas::findBySql($sql, [':enfermedad_id' => $this->id])->all();
    }
}
