<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\tabs\TabsX;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\sidenav\SideNav;
use backend\models\PerfilEmpresarial;

//$model = new PerfilEmpresarial();


// $items = [
//     [
//         'label'=>'<b>Informações básicas</b>',
//         'content'=>$this->render('_form', ['model' => $model]),
//         'active'=>$modeltrue,
//         //'linkOptions'=>['data-url'=>Url::to(['/index/Form'])]
//     ],
// ];


?>

<div class="row">
    <div class="col-md-2">
        <?php
        echo SideNav::widget([
            'type' => SideNav::TYPE_DEFAULT,
            // 'heading' => '<i class="glyphicon glyphicon-cog"></i> Operations',
            'items' => [
                [
                    'url' => '#',
                    'label' => 'Perfil',
                    'icon' => 'user'
                ],
                [
                    'url' => ['/perfil-empresarial/loadupdate'],
                    'label' => 'Editar Perfil',
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
        <?=
          $this->render('_form', 
                            [
                                'model' => $model,
                                'localizacao' => $localizacao,
                                'contato' => $contato,
                                'produtos' => $produtos,
                                'perfilative' => $perfilative,
                                'localative' => $localative,
                                'produtoative' => $produtoative,

                            ]);
        // Pjax::begin();
        // echo TabsX::widget([
        //     'items'=>$items,
        //     'position'=>TabsX::POS_ABOVE,
        //     'encodeLabels'=>false
        // ]);
        // Pjax::end();
        ?>  
    </div>
    </div>
</div>

