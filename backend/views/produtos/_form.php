<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Po */
/* @var $form yii\widgets\ActiveForm */
$prod_cont=0;
?>


<div class="po-form">
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

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($produtos as $i => $produto): ?>
                <?php  $prod_cont++ ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Produto <?=$prod_cont ?> </h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $produto->isNewRecord) {
                                echo Html::activeHiddenInput($produto, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($produto, "[{$i}]imagem")->widget(FileInput::className(), [
                                    'options' => ['accept' => 'image/*'],
                                    'pluginOptions' => [
                                        'previewFileType' => 'image',
                                        'showUpload' => false,
                                        'browseLabel' => '',
                                        'removeLabel' => '',
                                        'mainClass' => 'input-group-lg'
                                    ]
                                ])->label(false) ?>

                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($produto, "[{$i}]nome")->textInput(['maxlength' => true,'placeholder'=>$produto->getAttributeLabel('nome')])->label(false) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($produto, "[{$i}]preco")->textInput(['placeholder'=>$produto->getAttributeLabel('preco')])->label(false) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($produto, "[{$i}]desconto")->textInput(['placeholder'=>$produto->getAttributeLabel('desconto')])->label(false) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>

</div>



