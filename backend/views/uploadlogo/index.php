<?php

use yii\helpers\Html;
use yii\helpers\BaseHtml;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\PerfilEmpresarial */
/* @var $form yii\widgets\ActiveForm */

$root= Yii::getAlias('@webroot');
$base_url= Yii::$app->request->baseUrl;
$user_id=Yii::$app->user->getId();
?>

<div class="container2">
    <div class="row">
      <div class="col-xs-12 col-md-12">
        <div class="painel">
            <div class="sub-painel">

            <?php 
                echo FileInput::widget([
                    'name' => 'images[]',
                    'options'=>[
                        'multiple'=>true
                    ],
                    'pluginOptions' => [
                        'language'=> "en",
                        'uploadUrl' => Url::to(['/uploadlogo/create']),
                        'uploadExtraData' => [
                             'root' => $root,
                             'base_url' =>$base_url,
                             'user_id'=> $user_id,
                             'id' => "",
                        ],
                        'maxFileCount' => 1,
                        'allowedFileExtensions'=> ["jpg", "gif", "png", "txt"],

                    ]
                ]);
            ?>
        </div>

        </div>
      </div>
      
    </div>

    <div class="row">
      <div class="col-xs-12 col-md-12">
        <div class="painel">
            <div class="sub-painel">
                <h2 class="upload-footer-header">About.........</h2>
                <p class="upload-informational-footer">Lorem ipsum dolor sit amet, consectetur adipisicing elit, <a href="">Termos de Serviço</a> sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nulla pariatur.</p>
                <p class="upload-continue-footer-link">
                 <a href="<?= Url::to(['perfil-empresarial/loadupdate']) ?>"> Continuar --> </a>
                  
                </p>
            </div>
        </div>
      </div>
    </div>
</div>
