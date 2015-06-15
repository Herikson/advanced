<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\PerfilEmpresarial */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="container2">
    <div class="row">
      <div class="col-xs-12 col-md-9">
        <div class="painel">

            <?php 
                echo FileInput::widget([
                    'name' => 'logo',
                    'options'=>[
                        'multiple'=>true
                    ],
                    'pluginOptions' => [
                        'uploadUrl' => Url::to(['/perfil-empresarial/upload']),
                        // 'uploadExtraData' => [
                        //     'album_id' => 20,
                        //     'cat_id' => 'Nature'
                        // ],
                        'maxFileCount' => 1
                    ]
                ]);
            ?>

        </div>
      </div>
      <div class="col-xs-6 col-md-3">
        <div class="painel"> 
            .col-xs-6 .col-md-4
        </div>
    </div>
    </div>
    

</div>
