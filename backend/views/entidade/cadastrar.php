<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\tabs\TabsX;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\sidenav\SideNav;


$items = [
    [
        'label'=>'<b>Informações básicas</b>',
        'content'=>$this->render('_form', ['model' => $model]),
        'active'=>$modeltrue,
        //'linkOptions'=>['data-url'=>Url::to(['/index/Form'])]
    ],

    [
        'label'=>'<b>Localizacao</b>',
        'content'=>$this->render('/localizacao/_form', ['modelLocal' => $modelLocal,'id_entidade'=>$model->id]),
        'active'=>$modelLocaltrue,
        //'linkOptions'=>['data-url'=>Url::to(['/index/Form'])]
    ],
    /*[
        'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Dropdown',
        'items'=>[
             [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Option 1',
                 'encode'=>false,
                 'content'=>'',
                 'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=3'])]
             ],
             [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Option 2',
                 'encode'=>false,
                 'content'=>'',
                 'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=4'])]
             ],
        ],
    ],*/
];
?>
<div class="row">
    <div class="col-md-2">
        <?php
        echo SideNav::widget([
            'type' => SideNav::TYPE_DEFAULT,
            'heading' => '<i class="glyphicon glyphicon-cog"></i> Operations',
            'items' => [
                [
                    'url' => '#',
                    'label' => 'Editar Perfil',
                    'icon' => 'user'
                ],
                [
                    'url' => ['/entidade/create'],
                    'label' => 'Cadastrar Empresa',
                    'icon' => 'user'
                ],
                [
                    'label' => 'Help',
                    'icon' => 'question-sign',
                    'items' => [
                        ['label' => 'About', 'icon'=>'info-sign', 'url'=>'#'],
                        ['label' => 'Contact', 'icon'=>'phone', 'url'=>'#'],
                    ],
                ],
            ],
        ]);
        ?>
    </div>
    <div class="col-md-9">
    <div class="painel" >    
        <?php
        Pjax::begin();
        echo TabsX::widget([
            'items'=>$items,
            'position'=>TabsX::POS_ABOVE,
            'encodeLabels'=>false
        ]);
        Pjax::end();
        ?>  
    </div>
    </div>
</div>
