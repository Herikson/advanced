<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PerfilEmpresarialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Perfil Empresarials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perfil-empresarial-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Perfil Empresarial', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'perfil_pai_id',
            'nome',
            'descricao:ntext',
            'tipo',
            // 'Marcacoes:ntext',
            // 'visualizacoes',
            // 'site_url:url',
            // 'logo',
            // 'logo_rooturl:url',
            // 'Data_criacao',
            // 'user_id',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
