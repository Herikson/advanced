<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\db\ActiveRecord;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use kartik\tabs\TabsX;
use kartik\select2\Select2;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\layers\BicyclingLayer;

use backend\models\PerfilEmpresarial;
use backend\models\Pais;

if ($perfilative==0) {
    $perfilative=false;
}else{
    $perfilative=true;
}
if ($localative==0) {
    $localative=false;
}else{
    $localative=true;
}
if ($produtoative==0) {
    $produtoative=false;
}else{
    $produtoative=true;
}


$user_id=Yii::$app->user->getId(); 

if (!is_null($model->id)){
?>

    <div id="creator-subheader">
        <div class"creator-subheader-content" >
            <h2 id="creator-subheader-text" > 
            <?= is_null($model->nome) || $model->nome=="" ? '[ Nome ]' : $model->nome ?>
            </h2>
        </div>
    </div>
    <hr>
<div class="perfil-empresarial-form sub-painel">

    <?php $form = ActiveForm::begin(['options' => [ 'enctype' => 'multipart/form-data'],'action'=>['perfil-empresarial/loadupdate','id'=>$model->id],'id' => 'dynamic-form']); ?>
    
    <div class="form-group text-right">
       
    <?= Html::resetButton('Limpar', ['class' => 'btn btn-default btn-sm']) ?>
    <?= Html::submitButton('Gravar Alteracoes', ['class' => 'btn btn-primary btn-sm']) ?>
    
    </div>
    <hr>
    <div class="row">
            <div class="col-lg-6">
                <?php echo Html::img($model->logo, ['class' => 'logo-edit']); ?>
            </div>
            <div class="col-lg-6">
             <span class="info_perfil_pane">Informacoes extra:</span>
            <div class="row">
              <div class="col-md-3 info_perfil"><?= $model->getAttributeLabel('visualizacoes') ?>:</div>
              <div class="col-md-4 info_perfil"><?= $model->visualizacoes ?></div>
            </div>
            <div class="row">
              <div class="col-md-3 info_perfil"><?= $model->getAttributeLabel('Data_criacao') ?>:</div>
              <div class="col-md-4 info_perfil"><?= $model->Data_criacao ?></div>
            </div>
            
                
            </div>
    </div>
    <br></br>
    <?php 
    //conteudo Informacaoes Basicas:
    $content_1='
    <div class="row">
            <div class="col-lg-6">
            '.Html::activeHiddenInput($model, 'perfil_ative')
             .Html::activeHiddenInput($model, 'produto_ative')
             .$form->field($model, 'nome')->textInput(['maxlength' => true,'placeholder'=>'Nome'])->label(false)
             .$form->field($model, 'descricao')->textarea(['rows' => 6,'placeholder'=>'Descrição'])->label(false)
             .$form->field($model, 'Marcacoes')->textarea(['rows' => 6,'placeholder'=>'Marcações'])->label(false)
             .'  
            </div>
            <div class="col-lg-4">'
             .$form->field($model, 'perfil_pai_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(PerfilEmpresarial::find()->where(['user_id'=>$user_id])->andWhere('id!='.$model->id)->all(),'id','nome'),
                        'language' => 'pt',
                        'options' => ['placeholder' => $model->getAttributeLabel('perfil_pai_id')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false)
             .$form->field($model, 'tipo')->textInput(['maxlength' => true,'placeholder'=>'Tipo'])->label(false)
             .$form->field($model, 'site_url')->textInput(['maxlength' => true,'placeholder'=>'Url site'])->label(false)
             .$form->field($model, 'status')->radioList(['Ativo' => 'Ativo', 'Inativo' => 'Inativo'])->label(false)
             .'</div>
            <div class="col-lg-2">
            </div>
    </div>';
    //conteudo Localizacao:
    $content_2='
    <div class="row">
            <div class="col-lg-5">'
             .Html::activeHiddenInput($localizacao, 'perfil_empresarial_id', ['value' => $model->id])
             .Html::activeHiddenInput($localizacao, 'local_ative')
             .$form->field($localizacao, 'pais_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Pais::find()->all(),'paisId','paisNome'),
                        'language' => 'pt',
                        'options' => ['placeholder' => $localizacao->getAttributeLabel('pais_id')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false)
             .$form->field($localizacao, 'ilha_id')->textInput(['maxlength' => true,'placeholder'=>$localizacao->getAttributeLabel('ilha_id')])->label(false)
             .$form->field($localizacao, 'cidade')->textInput(['maxlength' => true,'placeholder'=>$localizacao->getAttributeLabel('cidade')])->label(false)
             .$form->field($localizacao, 'zona')->textInput(['maxlength' => true,'placeholder'=>$localizacao->getAttributeLabel('zona')])->label(false)
             .$form->field($localizacao, 'rua')->textInput(['maxlength' => true,'placeholder'=>$localizacao->getAttributeLabel('rua')])->label(false)
             .'
            </div>
            <div class="col-lg-7">'
             .$form->field($localizacao, 'google_local')->widget(
                'kolyunya\yii2\widgets\MapInputWidget',
                [

                    // Google maps browser key.
                    // 'key' => 'AIzaSyCLd3aiEUdP6f5SUd60lEqiF6Pp_YnZIVs',

                    // Initial map center latitude. Used only when the input has no value.
                    // Otherwise the input value latitude will be used as map center.
                    // Defaults to 0.
                    'latitude' => 42,

                    // Initial map center longitude. Used only when the input has no value.
                    // Otherwise the input value longitude will be used as map center.
                    // Defaults to 0.
                    'longitude' => 42,

                    // Initial map zoom.
                    // Defaults to 0.
                    'zoom' => 12,

                    // Map container width.
                    // Defaults to '100%'.
                    'width' => '100%',

                    // Map container height.
                    // Defaults to '300px'.
                    'height' => '230px',

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

                ]
            )->label(false).'
            </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-6">
        '.Html::activeHiddenInput($contato, 'perfil_empresarial_id', ['value' => $model->id])
         .$form->field($contato, 'email')->textInput(['maxlength' => true,'placeholder'=>$contato->getAttributeLabel('email')])->label(false)
         .$form->field($contato, 'telefone')->textInput(['maxlength' => true,'placeholder'=>$contato->getAttributeLabel('telefone')])->label(false)
         .$form->field($contato, 'telemovel')->textInput(['placeholder'=>$contato->getAttributeLabel('telemovel')])->label(false).
        '
        </div>
    </div>
    ';

    //conteudo Informacaoes Basicas:
    // $content_3='
    // <div class="row">
    //         <div class="col-lg-6">
    //         '.Html::activeHiddenInput($produtos, 'perfil_empresarial_id', ['value' => $model->id])
    //          .Html::activeHiddenInput($produtos, 'produto_ative')
    //          .$form->field($produtos, 'nome')->textInput(['maxlength' => true,'placeholder'=>'Nome'])->label(false)
    //          .$form->field($produtos, 'imagem')->textarea(['placeholder'=>'imagem'])->label(false)
    //          .$form->field($produtos, 'preco')->textInput(['placeholder'=>'preco'])->label(false)
    //          .$form->field($produtos, 'desconto')->textInput(['placeholder'=>'desconto'])->label(false)
    //          .$form->field($produtos, 'preco')->textInput(['placeholder'=>'preco'])->label(false)
    //          .'  
    //         </div>
    // </div>';

    $items = [
        [
            'label'=>'<b>Informações básicas</b>',
            'content'=>$content_1,
            'active'=>$perfilative,
            'options' => ['id' => 'infoA'],
        ],
        [
            'label'=>'<b>Localizacao</b>',
            'content'=>$content_2,
            'active'=>$localative,
            'options' => ['id' => 'infoB'],
        ],
        [
            'label'=>'<b>Produtos</b>',
            'content'=>$this->render('/produtos/_form', ['produtos' => $produtos,'form'=>$form]),
            'active'=>$produtoative,
            'options' => ['id' => 'infoC'],
        ],
    ];
    //---------------------------------------------------------------------
    //Separador:
    echo TabsX::widget([
        'items'=>$items,
        'position'=>TabsX::POS_ABOVE,
        'encodeLabels'=>false,
        // 'pluginEvents' => [
        //     "tabsX.click" => "function() { alert($(this).find('.active a').attr('href')); }"
        // ]
    ]);
    ?>

    <div class="form-group text-right">
    <span class="has_change" ></span>   
    <?= Html::resetButton('Limpar', ['class' => 'btn btn-default btn-sm']) ?>
    <?= Html::submitButton('Gravar Alteracoes', ['class' => 'btn btn-primary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
$('.form-control').change(function(){
    //var zipCod = $(this).val();
    $(".has_change").html('Algumas alterações ainda não foram gravados.');
    
 });

$('a').click(function(){

    var action=$(this).attr('href');

    if (action=='#infoA'){
    $('#perfilempresarial-perfil_ative').val(1);
    $('#localizacao-local_ative').val(0);
    $('#perfilempresarial-produto_ative').val(0);
    }
    if (action=='#infoB'){
    $('#perfilempresarial-perfil_ative').val(0);
    $('#localizacao-local_ative').val(1);
    $('#perfilempresarial-produto_ative').val(0);

    }
    if (action=='#infoC'){
    $('#perfilempresarial-perfil_ative').val(0);
    $('#localizacao-local_ative').val(0);
    $('#perfilempresarial-produto_ative').val(1);
    }
    
 });

JS;

$this->registerJS($script);

}else{
    //Listagem de todos os  registos:

    $registros = PerfilEmpresarial::find()->where(['user_id' => $user_id])->all();

    $count_regs = count($registros);
    if($count_regs > 0){
        $arr_regs = array();
        foreach($registros as $regs)
            array_push($arr_regs,$regs->attributes);
    }
    
    ?>
    <div id="creator-subheader">
        <div class"creator-subheader-content" >
            <h2 id="creator-subheader-text" >Empresas</h2> 
            <span id="creator-subheader-item-count" class="yt-badge-creator" ><?= $count_regs ?></span>
        </div>
    </div>
    <hr>
    <div class="sub-painel">

    <?php
    foreach ($arr_regs as $key => $value) {
        # code...
        ?>
        <div class="row">
            <div class="col-lg-2">
        <a href="<?= Url::to(['perfil-empresarial/loadupdate','id'=>$value['id']]) ?>"> 
        <?php
        echo Html::img($value['logo'],['class' => 'logo-link']);

        $date = date_create($value['Data_criacao']);
        $ano = date_format($date, 'Y');
        $mes = date_format($date, 'M');
        $dia = date_format($date, 'd');
        $hora = date_format($date, 'H:i');

        ?>
        </a>
            </div>
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-md-5 title-logo-link">
                    <?= $value['nome'] ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 info_perfil">
                        <?= $dia." de ".$mes." de ".$ano."  ".$hora ?>
                    </div>
                </div>
            </div>
        </div>
    </br>

<?php
    }

}
?>
    </div>
