<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Localizacao */

$this->title = 'Create Localizacao';
$this->params['breadcrumbs'][] = ['label' => 'Localizacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="localizacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
