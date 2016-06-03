<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Horarios */
?>
<div class="horarios-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tipo',
            'frecuencia',
            'diasemana',
            'dia_mes',
            'hora',
            'region',
            'instance_id',
            'volume_id',
            'encender',
            'apagar',
            'instance_reboot:boolean',
            'servidor_procesos',
            'estatus',
        ],
    ]) ?>

</div>
