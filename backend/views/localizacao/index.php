<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LocalizacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Localizacaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="localizacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Localizacao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'entidade_id',
            'pais',
            'ilha',
            'cidade',
            // 'zona',
            // 'rua',
            // 'google_latitude',
            // 'google_longitude',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
