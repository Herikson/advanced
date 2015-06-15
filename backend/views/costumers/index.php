<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CostumersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Costumers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="costumers-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Costumers', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'costumer_id',
            'costumer_name',
            'zip_code',
            'cidade',
            'provincia',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
