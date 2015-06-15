<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PerfilEmpresarial */

$this->title = 'Create Perfil Empresarial';
$this->params['breadcrumbs'][] = ['label' => 'Perfil Empresarials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perfil-empresarial-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
