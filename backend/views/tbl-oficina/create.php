<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TblOficina */

$this->title = 'Create Tbl Oficina';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Oficinas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-oficina-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
