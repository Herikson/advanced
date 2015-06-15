<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Adress */

$this->title = 'Create Adress';
$this->params['breadcrumbs'][] = ['label' => 'Adresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adress-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
