<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PerfilEmpresarial */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Perfil Empresarials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perfil-empresarial-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'perfil_pai_id',
            'nome',
            'descricao:ntext',
            'tipo',
            'Marcacoes:ntext',
            'visualizacoes',
            'site_url:url',
            'logo',
            'logo_rooturl:url',
            'Data_criacao',
            'user_id',
            'status',
        ],
    ]) ?>

</div>
