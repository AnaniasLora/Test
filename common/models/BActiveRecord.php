<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
//use yii\behaviors\TimestampBehavior;
//use app\components\behaviors\UserassingBehavior;
use yii\db\Expression;

/**
 * Clase base para extender en los modelos que mapean a las tablas de las base de datos.
 * @author Francisco Mahay <fmahay@palaceresorts.com>
 */
class BActiveRecord extends ActiveRecord
{
    /**
     * Constantes para identificar el estado de los registros:
     */
    const ESTADO_INACTIVO = 0;
    const ESTADO_ACTIVO = 1;
    const ESTADO_CANCELADO = 2;

    /**
     * Lista de clases css disponibles para el estado de los registros.
     */
    protected $listLabelClass = [
        0 => 'label-warning',
        1 => 'label-success',
        2 => 'label-danger',
    ];

    /**
     * Se especifican los comportamientos que tendrá el objeto al:
     *     * Crear un registro: Se asignarán las fechas de creación y actualización así como el usuario que realizó estos procesos.
     *     * Actualizar registro: Se asignará la fecha de actualización así como el usuario que realizó el proceso.
     *
     *  @return []  [array] Lista de los comportamientos configurados.
     */
    public function behaviors()
    {
        return [
        /**    [
            	/**
            	 * Se utiliza para actualizar las fechas de creación y actualización del registro
            	 */
            /**    'class' => TimestampBehavior::className(),
                'attributes' => [
                    'createdAtAttribute' => 'fecha_creacion',
                    'updatedAtAttribute' => 'fecha_ultima_modificacion',
                    ActiveRecord::EVENT_BEFORE_INSERT => ['fecha_creacion', 'fecha_ultima_modificacion'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['fecha_ultima_modificacion'],
                ],
                'value' => new Expression('NOW()'),
            ],
            [
            	/**
            	 * Se utiliza para actualizar el usuario que genera y actualiza del registro
            	 */
            /**    'class' => UserassingBehavior::className(),
                'attributes' => [
                    'createdAtAttribute' => 'usuario_creacion',
                    'updatedAtAttribute' => 'usuario_ultima_modificacion',
                    ActiveRecord::EVENT_BEFORE_INSERT => ['usuario_creacion', 'usuario_ultima_modificacion'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['usuario_ultima_modificacion'],
                ],
                'value' => (isset(Yii::$app->user) && !Yii::$app->user->getIsGuest()) ? Yii::$app->user->identity->username : null,
            ],**/
        ];
    }

    /**
     * Obtiene el texto del estado en el que se encuentre el registro, el cual puede ser alguno de los siguientes:
     *      * 0 - Inactivo
     *      * 1 - Activo
     *      * 2 - Cancelado
     *
     * @param   $estado [int]       Indica el estado del cual se quiere obtener el texto.
     * @return  $text   [string]    Texto del estado indicado o en su defecto del que tenga el objeto asignado.
     */
    public function getEstadoText($estado = null)
    {
        $listEstados = Yii::t('app', 'hlp-status');
        $text = '';

        if ($estado != null) {
            $text = $listEstados[$estado];
        } else {
            $text = $listEstados[$this->estado];
        }

        return $text;
    }
    public function getEstadoText2($estado = null)
    {
        $listEstados = Yii::t('app', 'hlp-status2');
        $text = '';

        if ($estado != null) {
            $text = $listEstados[$estado];
        } else {
            $text = $listEstados[$this->estado];
        }

        return $text;
    }

    /**
     * Obtiene la clase css correspondiente al estado en el que se encuentre el registro.
     *
     * @param   $estado     [int]       Indica el estado del cual se quiere obtener la clase css.
     * @return  $cssClass   [string]    Clase css del estado indicado o en su defecto del que tenga el objeto asignado.
     */
    public function getEstadoCssClass($estado = null)
    {
        $cssClass = '';

        if ($estado != null) {
            $cssClass = $this->listLabelClass[$estado];
        } else {
            $cssClass = $this->listLabelClass[$this->estado];
        }

        return $cssClass;
    }
}
