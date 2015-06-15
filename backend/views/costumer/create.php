<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Costumer */

$this->title = 'Create Costumer';
$this->params['breadcrumbs'][] = ['label' => 'Costumers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="costumer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
