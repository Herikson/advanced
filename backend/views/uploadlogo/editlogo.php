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
//

    echo FileInput::widget([
        'name' => 'images[]',
        'options'=>[
            'multiple'=>true
        ],
        'pluginOptions' => [
            'language'=> "pt",
            'uploadUrl' => Url::to(['/uploadlogo/create']),
            'uploadExtraData' => [
                 'root' => $root,
                 'base_url' =>$base_url,
                 'user_id'=> $user_id,
                 'id' => $model->id,
            ],
            'maxFileCount' => 1,
            'allowedFileExtensions'=> ["jpg", "gif", "png", "txt"],

        ],
        'pluginEvents' => [
            "fileuploaded" => "function() { location.reload(); }",
        ]
    ]);

?>
