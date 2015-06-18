<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\file\FileInput;
use kartik\label\LabelInPlace;

/* @var $this yii\web\View */
/* @var $model backend\models\Po */
/* @var $form yii\widgets\ActiveForm */
$prod_cont=0;
$config = ['template'=>"{input}\n{error}\n{hint}"]; // config to deactivate label for ActiveField

?>


    <div class='row'>
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $produtos[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'po_item_no',
                    'quantity',
                ],
            ]); ?>

            <div class="container-items sub-painel"><!-- widgetContainer -->
                <div class="form-group text-right">
                    <button type="button" class="add-item btn btn-default btn-xs"><i class="glyphicon glyphicon-plus"></i>Adicionar novo</button>
                </div>
            <?php foreach ($produtos as $i => $produto): ?>
                <?php  $prod_cont++ ?>
                <div class="item panel"><!-- widgetBody -->
                    
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $produto->isNewRecord) {
                                echo Html::activeHiddenInput($produto, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-1">
                                <div class="pull-right">
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                </div>
                            </div>
                            <div class="col-sm-5">

                                <?= $form->field($produto, "[{$i}]imagem")->widget(FileInput::className(), [
                                    'options' => ['accept' => 'image/*'],

                                    'pluginOptions' => [
                                        'showCaption'=> false,
                                        'previewFileType' => 'image',
                                        'showUpload' => false,
                                        'browseLabel' => 'Imagem produto',
                                        'removeLabel' => 'Eliminar',
                                        'removeClass' => 'btn btn-danger btn-sm fileinput-remove fileinput-remove-button',
                                        'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> ',
                                        'browseClass' => 'btn btn-default btn-sm btn-file',
                                        'browseIcon' => '<i class="glyphicon glyphicon-picture"></i> ',
                                        'mainClass' => 'input-group-lg',
                                        'overwriteInitial'=> true,
                                    ]
                                ])->label(false) ?>

                            </div>
                            <div class="col-sm-3">
                                
                                <?= $form->field($produto, "[{$i}]nome", $config)->widget(LabelInPlace::classname()) ?>
                                <?= $form->field($produto, "[{$i}]preco", $config)->widget(LabelInPlace::classname(),['label'=>'($) '.$produto->getAttributeLabel('preco'),'encodeLabel'=> false]) ?>
                                <?= $form->field($produto, "[{$i}]desconto", $config)->widget(LabelInPlace::classname(),['label'=>'(%) '.$produto->getAttributeLabel('desconto'),'encodeLabel'=> false]) ?>

                            </div>
                            
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>

</div>



