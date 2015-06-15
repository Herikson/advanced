<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TblClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-cliente-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tbl Cliente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'Nome',
            'BI',
            'Morada',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
