<?php

namespace app\models;

/**
 * This is the model class for table "animales".
 *
 * @property int $id
 * @property string $nombre
 * @property string $nacimiento
 * @property string $chip
 * @property string $peso
 * @property bool $ppp
 * @property bool $esterilizado
 * @property string $sexo
 * @property string $observaciones
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Acogidas[] $acogidas
 * @property AnimalesColores[] $animalesColores
 * @property Colores[] $colors
 * @property AnimalesEnfermedades[] $animalesEnfermedades
 * @property AnimalesRazas[] $animalesRazas
 * @property Razas[] $razas
 */
class Animales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'animales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nacimiento', 'chip'], 'default', 'value' => null],
            [['nacimiento'], 'date'],
            [['created_at', 'updated_at'], 'safe'],
            [['peso'], 'number'],
            [['ppp', 'esterilizado'], 'boolean'],
            [['observaciones'], 'string'],
            [['nombre', 'chip'], 'string', 'max' => 255],
            [['sexo'], 'string', 'max' => 6],
            [['chip'], 'unique'],
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
            'nacimiento' => 'Nacimiento',
            'chip' => 'Chip',
            'peso' => 'Peso',
            'ppp' => 'Ppp',
            'esterilizado' => 'Esterilizado',
            'sexo' => 'Sexo',
            'observaciones' => 'Observaciones',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcogidas()
    {
        return $this->hasMany(Acogidas::className(), ['animal_id' => 'id'])->inverseOf('animal');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalesColores()
    {
        return $this->hasMany(AnimalesColores::className(), ['animal_id' => 'id'])->inverseOf('animal');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColors()
    {
        return $this->hasMany(Colores::className(), ['id' => 'color_id'])->viaTable('animales_colores', ['animal_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalesEnfermedades()
    {
        return $this->hasMany(AnimalesEnfermedades::className(), ['animal_id' => 'id'])->inverseOf('animal');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimalesRazas()
    {
        return $this->hasMany(AnimalesRazas::className(), ['animal_id' => 'id'])->inverseOf('animal');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRazas()
    {
        return $this->hasMany(Razas::className(), ['id' => 'raza_id'])->viaTable('animales_razas', ['animal_id' => 'id']);
    }

    public function getColoresQueNoTengo()
    {
        // if (!isset($this->sintomasQueNoTengo)) {
        //     return $this->sintomasQueNoTengo;
        // }
        $sql = <<<'EOT'
select *
  from colores
except
select colores.*
  from colores
  join animales_colores
    on colores.id = animales_colores.color_id
 where animales_colores.animal_id = :animal_id
EOT;
        return Colores::findBySql($sql, [':animal_id' => $this->id])->all();
    }
}
