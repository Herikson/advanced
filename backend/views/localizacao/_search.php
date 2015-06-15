<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LocalizacaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="localizacao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'entidade_id') ?>

    <?= $form->field($model, 'pais') ?>

    <?= $form->field($model, 'ilha') ?>

    <?= $form->field($model, 'cidade') ?>

    <?php // echo $form->field($model, 'zona') ?>

    <?php // echo $form->field($model, 'rua') ?>

    <?php // echo $form->field($model, 'google_latitude') ?>

    <?php // echo $form->field($model, 'google_longitude') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
