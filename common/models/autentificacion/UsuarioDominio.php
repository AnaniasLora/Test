<?php
namespace common\models\autentificacion;

use Yii;
use \SoapClient;

/**
* Clase que se encarga de gestionar la autentificación de usuarios del sistema con las
* cuentas de dominio de Palace Resorts.
*
* @author Franciso Mahay <fmahay@palaceresorts.com>
*/
class UsuarioDominio
{

	/**
	 * Almacena el username que se intenta verificar.
	 */
	public $username;

	/**
	 * Almacena la contraseña del usuario.
	*/
	public $password;

	/**
	 * Indica si la autentificación fue valida.
	 */
	public $valido = false;

	/**
	 * Mensaje de al intentar realizar la autentificación.
	 */
	public $mensaje;

	public function __construct($username = '', $password = '')
	{
		$this->username = $username;
		$this->password = $password;
	}

	/**
	 *  Autentica el usuario especificado en username con la contraseña pwdtxt
	 * @return boolean Retorna true si el usuario esta autenticado
	 */
	public function validarPassword()
	{
		$request = new AutenticaUsuarioDominioRequest();
		$request->usuario = $this->username;
		$request->password = $this->password;

		try {
	       $client = new SoapClient(Yii::$app->params['webServiceLDAP'], array('classmap' => array('AutenticaUsuarioDominioResponse' => 'common\models\autentificacion\AutenticaUsuarioDominioResponse')));
	       $response = $client->ObtenerUsuarioValido($request);
	       $this->valido = $response->usuarioValido;
	       $this->mensaje = $response->mensaje;

		}catch (SoapFault $e) {
       		$mensaje = $e->getMessage();
     	}
 		catch(Exception $e){
   			$mensaje = $e->getMessage();
   		}
	}
}
