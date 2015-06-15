<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Costumers */

$this->title = 'Update Costumers: ' . ' ' . $model->costumer_id;
$this->params['breadcrumbs'][] = ['label' => 'Costumers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->costumer_id, 'url' => ['view', 'id' => $model->costumer_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="costumers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
