<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "usuarios_info".
 *
 * @property int $id
 * @property int $usuario_id
 * @property string $nombre
 * @property string $primer_apellido
 * @property string $segundo_apellido
 * @property string $login
 * @property string $password
 * @property string $email
 * @property string $access_token
 * @property string $validate_token
 * @property string $validated_at
 * @property int $rol_id
 */
class UsuariosInfo extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * Escenario activo para la creación de usuarios
     * @var string
     */
    const SCENARIO_CREATE = 'create';
    /**
    * Escenario activo para la actualización de usuarios
    * @var string
    */
    const SCENARIO_UPDATE = 'update';

    /**
     * Para verificar el password
     * @var string
     */
    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id'], 'default', 'value' => null],
            [['usuario_id'], 'integer'],
            [['login', 'email'], 'required'],
            [['auth_key'], 'safe'],
            [['nombre', 'primer_apellido', 'segundo_apellido', 'login', 'password', 'email', 'access_token', 'validate_token'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['login'], 'unique'],
            [['usuario_id'], 'unique'],
            [['password', 'password_repeat'], 'required', 'on' => [self::SCENARIO_CREATE]],
            [['password'], 'compare', 'on' => [self::SCENARIO_CREATE, self::SCENARIO_UPDATE]],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), ['password_repeat']);
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'nombre' => 'Nombre',
            'primer_apellido' => 'Primer Apellido',
            'segundo_apellido' => 'Segundo Apellido',
            'login' => 'Login',
            'password' => 'Password',
            'password_repeat' => 'Confirmar password',
            'email' => 'Email',
            'access_token' => 'Access Token',
            'validate_token' => 'Validate Token',
            'validated_at' => 'Validado',
            'rol_id' => 'Rol',
        ];
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @param null|mixed $type
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }
    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
    /**
     * Validates password.
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }


    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if ($insert) {
            if ($this->scenario === self::SCENARIO_CREATE) {
                goto salto;
            }
        } elseif ($this->scenario === self::SCENARIO_UPDATE) {
            if ($this->password === '') {
                $this->password = $this->getOldAttribute('password');
            } else {
                salto:
                $this->password = Yii::$app->security
                ->generatePasswordHash($this->password);
            }
        }
        return true;
    }
}
