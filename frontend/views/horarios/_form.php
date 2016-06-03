<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Horarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="horarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'frecuencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diasemana')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dia_mes')->textInput() ?>

    <?= $form->field($model, 'hora')->textInput() ?>

    <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instance_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'volume_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'encender')->textInput() ?>

    <?= $form->field($model, 'apagar')->textInput() ?>

    <?= $form->field($model, 'instance_reboot')->checkbox() ?>

    <?= $form->field($model, 'servidor_procesos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estatus')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
