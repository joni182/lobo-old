<?php

namespace app\models;

/**
 * This is the model class for table "animales".
 *
 * @property int $id
 * @property int $especie_id
 * @property string $nombre
 * @property string $nacimiento
 * @property string $defuncion
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
            [['nombre', 'especie_id'], 'required'],
            [[
                'nombre',
                'chip',
                'peso',
                'nacimiento',
                'defuncion',
                'sexo',
                'chip',
                'ppp',
                'observaciones',
            ], 'trim'],

            [[
                'nombre',
                'chip',
                'sexo',
                'chip',
            ], 'filter', 'filter' => 'strtolower'],
            [[
                'nombre',
                'chip',
                'nacimiento',
                'defuncion',
                'sexo',
                'chip',
            ], 'filter', 'filter' => function ($value) {
                return str_replace('.', '', $value);
            }],
            [['sexo'], 'match', 'pattern' => '/^[h|m]{1}$/'],
            [['nacimiento', 'chip', 'peso', 'sexo'], 'default', 'value' => null],
            [['peso'], 'number', 'min' => 0, 'max' => 9999],
            [['ppp', 'esterilizado'], 'boolean'],
            [['observaciones'], 'string'],
            [['nombre', 'chip', 'defuncion'], 'string', 'max' => 255],
            [['sexo'], 'string', 'max' => 6],
            [['chip'], 'unique'],
            [['especie_id'], 'integer'],
            [['especie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Especies::className(), 'targetAttribute' => ['especie_id' => 'id']],
            ['especie_id', function ($attribute, $params, $validator) {
                $razasDiscordantes = AnimalesRazas::find()->joinWith('raza')->where(['animal_id' => $this->id])->andWhere(['<>', 'especie_id', $this->especie_id])->all();
                foreach ($razasDiscordantes as $animal_raza) {
                    $animal_raza->delete();
                }
            }],
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
            'ppp' => 'PPP',
            'esterilizado' => 'Esterilizado',
            'sexo' => 'Sexo',
            'especie_id' => 'Especie',
            'observaciones' => 'Observaciones',
            'created_at' => 'Fecha Cçcreación',
            'updated_at' => 'Última modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEspecie()
    {
        return $this->hasOne(Especies::className(), ['id' => 'especie_id'])->inverseOf('animales');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTratamientos()
    {
        return $this->hasMany(Tratamientos::className(), ['animal_id' => 'id'])->inverseOf('animal');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedicamentos()
    {
        return $this->hasMany(Medicamentos::className(), ['id' => 'medicamento_id'])->viaTable('tratamientos', ['animal_id' => 'id']);
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

    public function getRazasQueNoTengo()
    {
        // if (!isset($this->sintomasQueNoTengo)) {
        //     return $this->sintomasQueNoTengo;
        // }
        $sql = <<<'EOT'
select *
  from Razas
where especie_id = :especie_id
except
select Razas.*
  from razas
  join animales_razas
    on razas.id = animales_razas.raza_id
 where animales_razas.animal_id = :animal_id
   and especie_id = :especie_id
EOT;
        return Razas::findBySql($sql, [':animal_id' => $this->id, ':especie_id' => $this->especie_id])->all();
    }
}
