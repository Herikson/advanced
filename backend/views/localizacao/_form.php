<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Pais;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

use dosamigos\google\maps\LatLng;
// use dosamigos\google\maps\services\DirectionsWayPoint;
// use dosamigos\google\maps\services\TravelMode;
// use dosamigos\google\maps\overlays\PolylineOptions;
// use dosamigos\google\maps\services\DirectionsRenderer;
// use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
// use dosamigos\google\maps\services\DirectionsRequest;
// use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;

/* @var $this yii\web\View */
/* @var $modelLocal backend\models\Localizacao */
/* @var $form yii\widgets\ActiveForm */

// <?= $form->field($modelLocal, 'entidade_id')->hiddenInput(['value'=>$id_entidade])->label(false)

?>

<div class="localizacao-form">

    <?php $form = ActiveForm::begin(['id'=>'form-localizao']); ?>
    <div class="body-content">
        <div class="form-group  text-right">
        <?php 
        if ($modelLocal->isNewRecord) {
        ?>    
        <?= Html::resetButton('Limpar', ['class' => 'btn btn-default btn-sm']) ?>
        <?= Html::submitButton('Gravar dados', ['class' => 'btn btn-primary btn-sm']) ?>
        <?php
        }
        ?>
        </div>
        <div class="row">
            <div class="col-lg-5">

                <?= Html::activeHiddenInput($modelLocal, 'entidade_id', ['value' => $id_entidade]) ?>

                <?=
                    $form->field($modelLocal, 'pais')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Pais::find()->all(),'paisId','paisNome'),
                        'language' => 'pt',
                        'options' => ['placeholder' => 'Paises ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                ?>
                <?= $form->field($modelLocal, 'ilha')->textInput(['maxlength' => true]) ?>

                <?= $form->field($modelLocal, 'cidade')->textInput(['maxlength' => true]) ?>

                <?= $form->field($modelLocal, 'zona')->textInput(['maxlength' => true]) ?>

                <?= $form->field($modelLocal, 'rua')->textInput(['maxlength' => true]) ?>

            </div>

            <div class="col-lg-5">

                <?= $form->field($modelLocal, 'local')->widget(
                'kolyunya\yii2\widgets\MapInputWidget',
                [

                    // Google maps browser key.
                    'key' => 'AIzaSyCLd3aiEUdP6f5SUd60lEqiF6Pp_YnZIVs',

                    // Initial map center latitude. Used only when the input has no value.
                    // Otherwise the input value latitude will be used as map center.
                    // Defaults to 0.
                    'latitude' => 14.91870260911325,

                    // Initial map center longitude. Used only when the input has no value.
                    // Otherwise the input value longitude will be used as map center.
                    // Defaults to 0.
                    'longitude' => -23.509459421038628,

                    // Initial map zoom.
                    // Defaults to 0.
                    'zoom' => 6,

                    // Map container width.
                    // Defaults to '100%'.
                    'width' => '555px',

                    // Map container height.
                    // Defaults to '300px'.
                    'height' => '360px',

                    // Coordinates representation pattern. Will be use to construct a value of an actual input.
                    // Will also be used to parse an input value to show the initial input value on the map.
                    // You can use two macro-variables: '%latitude%' and '%longitude%'.
                    // Defaults to '(%latitude%,%longitude%)'.
                    'pattern' => '[%longitude%-%latitude%]',

                    // Google map type. See official Google maps reference for details.
                    // Defaults to 'roadmap'
                    //'mapType' => 'satellite',

                    // Marker animation behavior defines if a marker should be animated on position change.
                    // Defaults to false.
                    'animateMarker' => true,

                    // Map alignment behavior defines if a map should be centered when a marker is repositioned.
                    // Defaults to true.
                    'alignMapCenter' => false,

                ]) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
