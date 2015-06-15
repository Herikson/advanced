<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
//use kartik\form\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\Entidade */
/* @var $form yii\widgets\ActiveForm */

//<img src="..." alt="..." class="img-thumbnail">
?>

<div class="entidade-form">

    <?= \lajax\languagepicker\widgets\LanguagePicker::widget([
    'skin' => \lajax\languagepicker\widgets\LanguagePicker::SKIN_BUTTON,
    'size' => \lajax\languagepicker\widgets\LanguagePicker::SIZE_SMALL]); 
    ?>

    <?php $form = ActiveForm::begin([
                                'id'=>'form-entidade'
                                ]); ?>
    <div class="form-group text-right">
    <?php 
    if ($model->isNewRecord) {
    ?>    
    <?= Html::resetButton('Limpar', ['class' => 'btn btn-default btn-sm']) ?>
    <?= Html::submitButton('Gravar dados', ['class' => 'btn btn-primary btn-sm']) ?>
    <?php
    }
    ?>
    </div>
    <hr>
    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <?php 
                    echo FileInput::widget([
                        'name' => 'logo',
                        'options'=>[
                            'multiple'=>true
                        ],
                        'pluginOptions' => [
                            'uploadUrl' => Url::to(['/site/file-upload']),
                            'uploadExtraData' => [
                                'album_id' => 20,
                                'cat_id' => 'Nature'
                            ],
                            'maxFileCount' => 1
                        ]
                    ]);
                ?>
            </div>
            <div class="col-lg-6">
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($model, 'tp_entidade_id')->textInput() ?>

                <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'Marcacoes')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'link')->textInput(['maxlength' => true,'placeholder'=>'https://www.site.com']) ?>
            </div>
            <div class="col-lg-6">

                <?= $form->field($model, 'descricao')->textarea(['rows' => 15]) ?>


                <?= $form->field($model, 'entidade_status')->dropDownList([ 'active' => 'Ativo', 'inactive' => 'Inativo', ], ['prompt' => '']) ?>
            </div>
        </div>
    </div>
    
    <div class="form-group text-right">
    <?php 
    if ($model->isNewRecord) {
    ?> 
    <span class="control"></span>   
    <?= Html::resetButton('Limpar', ['class' => 'btn btn-default btn-sm']) ?>
    <?= Html::submitButton('Gravar dados', ['class' => 'btn btn-primary btn-sm']) ?>
    <?php
    }
    ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
/*$.get('index.php?r=locations/get-city-province',{zipId : zipCod},
        function(data){
           var data = $.parseJSON(data);
           $('#costumers-cidade').attr('value',data.cidade);
           $('#costumers-provincia').attr('value',data.provincia);
        }
    );*/

$script = <<< JS
$('.form-control').change(function(){
    //var zipCod = $(this).val();
    $(".control").html('Algumas alterações ainda não foram salvas.');
    
 });

JS;

$this->registerJS($script);
?>

