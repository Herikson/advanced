<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Entidade;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\EntidadeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entidades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entidade-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Entidade', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
  
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nome',
            'descricao:ntext',
            'tp_entidade_id',
            'Marcacoes:ntext',
            // 'visualizacoes',
            // 'link',
            // 'logo',
            // 'user_id',
            // 'entidade_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
