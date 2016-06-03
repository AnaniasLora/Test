<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "horarios".
 *
 * @property integer $id
 * @property string $tipo
 * @property string $frecuencia
 * @property string $diasemana
 * @property integer $dia_mes
 * @property string $hora
 * @property string $region
 * @property string $instance_id
 * @property string $volume_id
 * @property string $encender
 * @property string $apagar
 * @property boolean $instance_reboot
 * @property string $servidor_procesos
 * @property string $estatus
 */
class Horarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'horarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dia_mes'], 'integer'],
            [['hora', 'encender', 'apagar'], 'safe'],
            [['instance_reboot'], 'boolean'],
            [['tipo'], 'string', 'max' => 20],
            [['frecuencia', 'diasemana'], 'string', 'max' => 10],
            [['region', 'instance_id', 'volume_id', 'servidor_procesos'], 'string', 'max' => 15],
            [['estatus'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
            'frecuencia' => 'Frecuencia',
            'diasemana' => 'Diasemana',
            'dia_mes' => 'Dia Mes',
            'hora' => 'Hora',
            'region' => 'Region',
            'instance_id' => 'Instance ID',
            'volume_id' => 'Volume ID',
            'encender' => 'Encender',
            'apagar' => 'Apagar',
            'instance_reboot' => 'Instance Reboot',
            'servidor_procesos' => 'Servidor Procesos',
            'estatus' => 'Estatus',
        ];
    }
}
