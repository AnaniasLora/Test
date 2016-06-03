<?php

namespace app\models;

use Yii;
use app\models\autentificacion\UsuarioDominio;
use yii\web\IdentityInterface;
use yii\helpers\ArrayHelper;
use common\models\BActiveRecord;


/**
 * This is the model class for table "Def_Usuario".
 *
 * @property string $username
 * @property string $hotel
 * @property integer $id_tipousuario
 * @property string $password
 * @property string $NoColaborador
 * @property string $tittle
 * @property string $name
 * @property string $estado
 * @property string $usuario_creacion
 * @property string $fecha_creacion
 * @property string $usuario_ultima_modificacion
 * @property string $fecha_ultima_modificacion
 *
 * @property DefTipoUsuario $idDefTipoUsuario
 */
class Usuario extends BActiveRecord implements IdentityInterface
{
    public $permissions = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Def_Usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'id_tipousuario'], 'required'],
            [['id_tipousuario'], 'integer'],
            [['fecha_creacion', 'fecha_ultima_modificacion'], 'safe'],
            [['username', 'password', 'tittle', 'name', 'usuario_creacion', 'usuario_ultima_modificacion'], 'string', 'max' => 45],
            [['hotel'], 'string', 'max' => 6],
            [['NoColaborador'], 'string', 'max' => 10],
            [['estado'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'hotel' => Yii::t('app', 'Hotel'),
            'id_tipousuario' => Yii::t('app', 'Id Def  Tipo Usuario'),
            'password' => Yii::t('app', 'Password'),
            'NoColaborador' => Yii::t('app', 'No Colaborador'),
            'tittle' => Yii::t('app', 'Tittle'),
            'name' => Yii::t('app', 'Name'),
            'estado' => Yii::t('app', 'Estado'),
            'usuario_creacion' => Yii::t('app', 'Usuario Creacion'),
            'fecha_creacion' => Yii::t('app', 'Fecha Creacion'),
            'usuario_ultima_modificacion' => Yii::t('app', 'Usuario Ultima Modificacion'),
            'fecha_ultima_modificacion' => Yii::t('app', 'Fecha Ultima Modificacion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDefTipoUsuario()
    {
        return $this->hasOne(DefTipoUsuario::className(), ['id_tipousuario' => 'id_tipousuario']);
    }

    public function getAuthItems()
    {
        return AuthAssignment::find()->where('user_id = :_user', [':_user' => $this->username])->all();
    }


    /**
     * Busca un usuario activo con el username indicado.
     *
     * @param $id [string] Username del usuario que se va a buscar.
     * @return IdentityInterface | null Usario encontrado con el username indicado.
     */
    public static function findIdentity($id)
    {
        return static::findOne(['username' => $id, 'estado' => 1]);
    }

    /**
     * Búsqueda de usuario por el token indicado.
     * NOTA: POR EL MOMENTO NO SE REQUIERE ESTA FUNCIÓN.
     *
     * @param $token [string] Token por el que se buscará el usuario.
     * @return IdentityInterface|null Usuario encontrado con el token indicado.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    /**
     * @return [string] Devuelve el username del usuario.
     */
    public function getId()
    {
        return $this->username;
    }

    /**
     * NOTA: POR EL MOMENTO NO SE REQUIERE ESTA FUNCIÓN.
     * @return [string] clave de autentificación del usuario.
     */
    public function getAuthKey()
    {

    }

    /**
     * Verifica que la clave de autentificación del usuario sea correcta.
     * NOTA: POR EL MOMENTO NO SE REQUIERE ESTA FUNCIÓN.
     *
     * @param $authKey [authKey] Clave de autentificación.
     * @return boolean Indica si la clave de autentificación es correcta.
    */
    public function validateAuthKey($authKey)
    {

    }

    public function validatePassword($password)
    {
        $usuarioDominio = new UsuarioDominio($this->username, $password);
        $usuarioDominio->validarPassword();

        return $usuarioDominio->valido;
    }

    /**
     * Obtiene los roles y permisos disponibles para el usuario. El proceso descarta los que
     * ya tenga asignados el usuario.
     *
     * @return $data [] Lista de roles y permisos disponibles.
     */
    public function getAvailablePermissions()
    {
        $available = AuthItem::find()->all();
        $disabled  = ArrayHelper::getColumn($this->authItems, 'item_name');
        foreach ($available as $key => $item) {
            $exist = in_array($item->name, $disabled);
            if ($exist)
                unset($available[$key]);
        }
        $data = ArrayHelper::map($available, 'name', 'name', function ($item) {
            return $item->getTipoText();
        });
        return $data;
    }

    /**
     * Obtiene la lista de permisos disponbles en un arreglo simple. Únicamente contiene la información
     * necesaria para mostrarla en un list simple.
     *
     * @return $list [] Lista de items.
     */
    public function getAuthItemsToList()
    {
        $list = [];
        foreach ($this->authItems as $item) {
            $list[] = ['name' => $item->item_name, 'username' => $item->user_id, 'type' => $item->itemName->getTipoText()];
        }
        return $list;
    }
}
