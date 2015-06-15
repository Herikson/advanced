<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Entidade */

$this->title = 'Create Entidade';
$this->params['breadcrumbs'][] = ['label' => 'Entidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entidade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
