<?php
namespace common\models\autentificacion;
/**
 * User: trocha
 * Date: 12/11/12
 * Time: 12:15 PM
 * To change this template use File | Settings | File Templates.
 */

 class AutenticaUsuarioDominioResponse
 {
  /**
  * @var boolean
  * @soap
  **/
  public $usuarioValido;


  /**
  * @var string
  * @soap
  **/
  public $mensaje;

  public function __construct(){}
 }
