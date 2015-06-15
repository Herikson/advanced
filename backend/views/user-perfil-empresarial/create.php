<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UserPerfilEmpresarial */

$this->title = 'Create User Perfil Empresarial';
$this->params['breadcrumbs'][] = ['label' => 'User Perfil Empresarials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-perfil-empresarial-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
