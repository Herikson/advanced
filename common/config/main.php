<?php

return [
	'language' => 'pt-PT',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => ['languagepicker'],
    'components' => [
    	'languagepicker' => [
	        'class' => 'lajax\languagepicker\Component',
	        'languages' => ['pt-PT', 'en-US'],         // List of available languages (icons only)
	        'cookieName' => 'language',                         // Name of the cookie.
	        'expireDays' => 64,                                 // The expiration time of the cookie is 64 days.
	        'callback' => function() {
	            if (!\Yii::$app->user->isGuest) {
	                $user = \Yii::$app->user->identity;
	                $user->language = \Yii::$app->language;
	                $user->save();
	            }
	        }
	    ],
    	'i18n' => [
	        'translations' => [
	            'frontend*' => [
	                'class' => 'yii\i18n\PhpMessageSource',
	                'basePath' => '@common/messages',
	            ],
	            'backend*' => [
	                'class' => 'yii\i18n\PhpMessageSource',
	                'basePath' => '@common/messages',
	            ],
	        ],
	    ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
