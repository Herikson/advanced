<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserPerfilEmpresarial */

$this->title = 'Update User Perfil Empresarial: ' . ' ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'User Perfil Empresarials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-perfil-empresarial-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
