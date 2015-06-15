<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserPerfilEmpresarialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Perfil Empresarials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-perfil-empresarial-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Perfil Empresarial', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
            'perfil_empresarial_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
