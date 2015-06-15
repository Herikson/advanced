<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Costumers */

$this->title = 'Create Costumers';
$this->params['breadcrumbs'][] = ['label' => 'Costumers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="costumers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
