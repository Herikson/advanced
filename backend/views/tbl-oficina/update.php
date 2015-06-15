<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TblOficina */

$this->title = 'Update Tbl Oficina: ' . ' ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Oficinas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-oficina-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
