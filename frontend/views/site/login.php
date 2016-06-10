<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login" >
    <h1 align= center><?= Html::encode($this->title) ?></h1>

    <p align= center>Por favor rellene los campos para iniciar sesion</p>

    <div class="row" align= center>
        <div class="col-lg-5" align= center>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <img src="../views/layouts/imagenes/user.png" width="100" height="100"/> <br />

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])  ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
