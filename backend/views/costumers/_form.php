<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Locations;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\models\Costumers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="costumers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'costumer_name')->textInput(['maxlength' => 100]) ?>

    <?=
    $form->field($model, 'zip_code')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Locations::find()->all(),'local_id','zip_code'),
        'language' => 'pt',
        'options' => ['placeholder' => 'Select a zip code ...','id'=>'zipCode'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'cidade')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'provincia')->textInput(['maxlength' => 100]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
$('#zipCode').change(function(){
	var zipCod = $(this).val();

 	$.get('index.php?r=locations/get-city-province',{zipId : zipCod},
        function(data){
           var data = $.parseJSON(data);
           $('#costumers-cidade').attr('value',data.cidade);
           $('#costumers-provincia').attr('value',data.provincia);
        }
    );
 });

JS;
$this->registerJS($script);
?>
