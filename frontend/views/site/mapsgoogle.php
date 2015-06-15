<?php
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

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kolyunya\yii2\widgets;
use dosamigos\gallery\Gallery;
use dosamigos\gallery\Carousel;
use zxbodya\yii2\galleryManager;
use pendalf89\filemanager\widgets\FileInput;
use pendalf89\tinymce\TinyMce;
use yii\grid\GridView;

use host33\multilevelverticalmenu\MultilevelVerticalMenu;
use kartik\tabs\TabsX;
use yii\helpers\Url;

?>

<div class="body-content">

        <div class="row">
            <div class="col-lg-2">
<?php
echo MultilevelVerticalMenu::widget(
array(
"menu"=>array(
  array("url"=>array(),
               "label"=>"Products",
          array("url"=>array(
                       "route"=>"/site/mapsgoogle"),
                       "label"=>"Create product",),
          array("url"=>array(
                      "route"=>"/product/list"),
                      "label"=>"Product List",),
          array("url"=>array(),
                       "label"=>"View Products",
          array("url"=>array(
                       "route"=>"/product/show",
                       "params"=>array("id"=>3),
                       "htmlOptions"=>array("title"=>"title")),
                       "label"=>"Product 3"),
            array("url"=>array(),
                         "label"=>"Product 4",
                array("url"=>array(
                             "route"=>"/product/show",
                             "params"=>array("id"=>5)),
                             "label"=>"Product 5")))),
          array("url"=>array(
                       "route"=>"/event/create"),
                       "label"=>"Sales"),
          array("url"=>array(
                       "route"=>"/event/create"),
                       "label"=>"Extensions",
                       "visible"=>false),
          array("url"=>array(),
                       "label"=>"Documentation",
              array("url"=>array(
                           "link"=>"http://www.yiiframework.com",
                           "htmlOptions"=>array("target"=>"_BLANK")),
                           "label"=>"Yii Framework"),
          array("url"=>array(),
                       "label"=>"Clothes",
          array("url"=>array(
                       "route"=>"/product/men",
                       "params"=>array("id"=>3),
                       "htmlOptions"=>array("title"=>"title")),
                       "label"=>"Men"),
            array("url"=>array(),
                         "label"=>"Women",
                array("url"=>array(
                             "route"=>"/product/scarves",
                             "params"=>array("id"=>5)),
                             "label"=>"Scarves"))),
              array("url"=>array(
                           "route"=>"site/menuDoc"),
                           "label"=>"Disabled Link",
                           "disabled"=>true),
                )
          ),
    "transition" => 1 // To choose between 1,2,3,4 and 5. 
)
);
?>

</div>
<div class="col-lg-10">

<?php
$items = [
    [
        'label'=>'<i class="glyphicon glyphicon-home"></i> <b>Informações básicas</b>',
        'content'=>$this->render('highcharts'),
        'active'=>true,
        //'linkOptions'=>['data-url'=>Url::to(['/site/highcharts'])]
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-user"></i> Profile',
        'content'=>'',
        'linkOptions'=>['data-url'=>Url::to(['/site/tabsdata'])]
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Dropdown',
        'items'=>[
             [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Option 1',
                 'encode'=>false,
                 'content'=>'',
                 'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=3'])]
             ],
             [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Option 2',
                 'encode'=>false,
                 'content'=>'',
                 'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=4'])]
             ],
        ],
    ],
];


echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_ABOVE,
    'encodeLabels'=>false
]);
?>

<?php $items = [
    [
        'url' => 'http://farm8.static.flickr.com/7429/9478294690_51ae7eb6c9_b.jpg',
        'src' => 'http://farm8.static.flickr.com/7429/9478294690_51ae7eb6c9_s.jpg',
        'options' => array('title' => 'Camposanto monumentale (inside)')
    ],
    [
        'url' => 'http://farm4.static.flickr.com/3712/9478186779_81c2e5f7ef_b.jpg',
        'src' => 'http://farm4.static.flickr.com/3712/9478186779_81c2e5f7ef_s.jpg',
        'options' => array('title' => 'Sail us to the Moon')
    ],
    [
        'url' => 'http://farm4.static.flickr.com/3789/9476654149_b4545d2f25_b.jpg',
        'src' => 'http://farm4.static.flickr.com/3789/9476654149_b4545d2f25_s.jpg',
        'options' => array('title' => 'Sail us to the Moon')
    ],
    [
        'url' => 'http://farm8.static.flickr.com/7429/9478868728_e9109aff37_b.jpg',
        'src' => 'http://farm8.static.flickr.com/7429/9478868728_e9109aff37_s.jpg',
        'options' => array('title' => 'Sail us to the Moon')
    ],
    [
        'url' => 'http://farm4.static.flickr.com/3825/9476606873_42ed88704d_b.jpg',
        'src' => 'http://farm4.static.flickr.com/3825/9476606873_42ed88704d_s.jpg',
        'options' => array('title' => 'Sail us to the Moon')
    ],
    [
        'url' => 'http://farm4.static.flickr.com/3749/9480072539_e3a1d70d39_b.jpg',
        'src' => 'http://farm4.static.flickr.com/3749/9480072539_e3a1d70d39_s.jpg',
        'options' => array('title' => 'Sail us to the Moon')
    ],
    [
        'url' => 'http://farm8.static.flickr.com/7352/9477439317_901d75114a_b.jpg',
        'src' => 'http://farm8.static.flickr.com/7352/9477439317_901d75114a_s.jpg',
        'options' => array('title' => 'Sail us to the Moon')
    ],
    [
        'url' => '././uploads/2015/05/ar-condicionado-split-samsung-24.000-btus-friomax-plus-as24uwbuxaz-c-virus-doctor-202986200.jpg',
        'src' => '././uploads/2015/05/ar-condicionado-split-samsung-24.000-btus-friomax-plus-as24uwbuxaz-c-virus-doctor-202986200-100x100.jpg',
        'options' => array('title' => 'Sail us to the Moon')
    ],
    [
        'url' => 'http://farm4.static.flickr.com/3802/9478895708_ccb710cfd1_b.jpg',
        'src' => 'http://farm4.static.flickr.com/3802/9478895708_ccb710cfd1_s.jpg',
        'options' => array('title' => 'Sail us to the Moon')
    ],
];?>
<div style="width:555px;height:200px;border:1px solid gray;padding:10px;">
<?= Gallery::widget(['items' => $items]);?>
</div>
<?php $items = [
    [
        'title' => 'Sintel',
        'href' => 'http://media.w3.org/2010/05/sintel/trailer.mp4',
        'type' => 'video/mp4',
        'poster' => 'http://media.w3.org/2010/05/sintel/poster.png'
    ],
    [
        'title' => 'Big Buck Bunny',
        'href' => 'http://upload.wikimedia.org/wikipedia/commons/7/75/Big_Buck_Bunny_Trailer_400p.ogg',
        'type' => 'video/ogg',
        'poster' => 'http://upload.wikimedia.org/wikipedia/commons/thumb/7/70/Big.Buck.Bunny.-.Opening.Screen.png/' .
            '800px-Big.Buck.Bunny.-.Opening.Screen.png'
    ],
    [
        'title' => 'Elephants Dream',
        'href' => 'http://upload.wikimedia.org/wikipedia/commons/transcoded/8/83/Elephants_Dream_%28high_quality%29.ogv/' .
            'Elephants_Dream_%28high_quality%29.ogv.360p.webm',
        'type' => 'video/webm',
        'poster' => 'http://upload.wikimedia.org/wikipedia/commons/thumb/9/90/Elephants_Dream_s1_proog.jpg/' .
            '800px-Elephants_Dream_s1_proog.jpg'
    ],
    [
        'title' => 'LES TWINS - An Industry Ahead',
        'href' => 'http://www.youtube.com/watch?v=zi4CIXpx7Bg',
        'type' => 'text/html',
        'youtube' => 'zi4CIXpx7Bg',
        'poster' => 'http://img.youtube.com/vi/zi4CIXpx7Bg/0.jpg'
    ],
    [
        'title' => 'KN1GHT - Last Moon',
        'href' => 'http://vimeo.com/73686146',
        'type' => 'text/html',
        'vimeo' => '73686146',
        'poster' => 'http://b.vimeocdn.com/ts/448/835/448835699_960.jpg'
    ]
];?>
<?= Carousel::widget([
    'items' => $items]);
?>
<br><br><br>
<?php



echo FileInput::widget([
    'name' => 'mediafile',
    'buttonTag' => 'button',
    'buttonName' => 'Browse',
    'buttonOptions' => ['class' => 'btn btn-default'],
    'options' => ['class' => 'form-control'],
    // Widget template
    'template' => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
    // Optional, if set, only this image can be selected by user
    'thumb' => 'original',
    // Optional, if set, in container will be inserted selected image
    'imageContainer' => '.img',
    // Default to FileInput::DATA_URL. This data will be inserted in input field
    'pasteData' => FileInput::DATA_URL,
    // JavaScript function, which will be called before insert file data to input.
    // Argument data contains file data.
    // data example: [alt: "Ведьма с кошкой", description: "123", url: "/uploads/2014/12/vedma-100x100.jpeg", id: "45"]
    'callbackBeforeInsert' => 'function(e, data) {
        console.log( data );
    }',
]);

 $form = ActiveForm::begin(['id' => 'form-signup']); ?>


               <?= $form->field($model, 'original_thumbnail')->widget(TinyMCE::className(), [
    'clientOptions' => [
           'language' => 'ru',
        'menubar' => false,
        'height' => 500,
        'image_dimensions' => false,
        'plugins' => [
            'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code contextmenu table',
        ],
        'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
    ],
]); ?>
                <?= $form->field($model, 'original_thumbnail')->widget(FileInput::className(), [
    'buttonTag' => 'button',
    'buttonName' => 'Browse',
    'buttonOptions' => ['class' => 'btn btn-default'],
    'options' => ['class' => 'form-control'],
    // Widget template
    'template' => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
    // Optional, if set, only this image can be selected by user
    'thumb' => 'original',
    // Optional, if set, in container will be inserted selected image
    'imageContainer' => '.img',
    // Default to FileInput::DATA_URL. This data will be inserted in input field
    'pasteData' => FileInput::DATA_URL,
    // JavaScript function, which will be called before insert file data to input.
    // Argument data contains file data.
    // data example: [alt: "Ведьма с кошкой", description: "123", url: "/uploads/2014/12/vedma-100x100.jpeg", id: "45"]
    'callbackBeforeInsert' => 'function(e, data) {
        console.log( data );
    }',
]) ?>
                <?= $form->field($model, 'coordinates')->widget(
    'kolyunya\yii2\widgets\MapInputWidget',
    [

        // Google maps browser key.
        'key' => 'AIzaSyCLd3aiEUdP6f5SUd60lEqiF6Pp_YnZIVs',

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
        'width' => '300px',

        // Map container height.
        // Defaults to '300px'.
        'height' => '200px',

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
) ?>
           
            <?php ActiveForm::end(); ?>
<?php 

$coord = new LatLng(['lat' =>  14.98193315445839 , 'lng' =>-23.505849838256836]);
$map = new Map([
    'center' => $coord,
    'zoom' => 16,
    'width' => 600,
    'height' => 600,
]);

/*// lets use the directions renderer
$home = new LatLng(['lat' => 39.720991014764536, 'lng' => 2.911801719665541]);
$school = new LatLng(['lat' => 39.719456079114956, 'lng' => 2.8979293346405166]);
$santo_domingo = new LatLng(['lat' => 39.72118906848983, 'lng' => 2.907628202438368]);

// setup just one waypoint (Google allows a max of 8)
$waypoints = [
    new DirectionsWayPoint(['location' => $santo_domingo])
];

$directionsRequest = new DirectionsRequest([
    'origin' => $home,
    'destination' => $school,
    'waypoints' => $waypoints,
    'travelMode' => TravelMode::DRIVING
]);

// Lets configure the polyline that renders the direction
$polylineOptions = new PolylineOptions([
    'strokeColor' => '#FFAA00',
    'draggable' => true
]);

// Now the renderer
$directionsRenderer = new DirectionsRenderer([
    'map' => $map->getName(),
    'polylineOptions' => $polylineOptions
]);

// Finally the directions service
$directionsService = new DirectionsService([
    'directionsRenderer' => $directionsRenderer,
    'directionsRequest' => $directionsRequest
]);

// Thats it, append the resulting script to the map
$map->appendScript($directionsService->getJs());
*/
// Lets add a marker now
$marker = new Marker([
    'position' => $coord,
    'title' => 'My Home Town',
]);

// Provide a shared InfoWindow to the marker
$marker->attachInfoWindow(
    new InfoWindow([
        'content' => '<p>This is my super cool content</p>'
    ])
);

// Add marker to the map
$map->addOverlay($marker);

// Now lets write a polygon
/*$coords = [
    new LatLng(['lat' => 25.774252, 'lng' => -80.190262]),
    new LatLng(['lat' => 18.466465, 'lng' => -66.118292]),
    new LatLng(['lat' => 32.321384, 'lng' => -64.75737]),
    new LatLng(['lat' => 25.774252, 'lng' => -80.190262])
];

$polygon = new Polygon([
    'paths' => $coords
]);

// Add a shared info window
$polygon->attachInfoWindow(new InfoWindow([
        'content' => '<p>This is my super cool Polygon</p>'
    ]));

// Add it now to the map
$map->addOverlay($polygon);*/


// Lets show the BicyclingLayer :)
$bikeLayer = new BicyclingLayer(['map' => $map->getName()]);

// Append its resulting script
//$map->appendScript($bikeLayer->getJs());

// Display the map -finally :)
echo $map->display();

?>

</div>
</div>

</div>