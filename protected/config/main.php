<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'              =>  dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'                  =>  'Airmate',

	// preloading 'log' component
	'preload'               =>  array('log'),

	// autoloading model and component classes
	'import'                =>  array(
		'application.models.*',
		'application.models.lottery_draw.*',
		'application.components.*',
	),

	'modules'               =>  array(
		// uncomment the following to enable the Gii tool

		/*'gii'                   =>  array(
			'class'                 =>  'system.gii.GiiModule',
			'password'              =>  '123456',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'         =>  array('127.0.0.1','::1'),
		),*/

	),

	// application components
	'components'            =>  array(
		/*'user'                  =>  array(
			// enable cookie-based authentication
			'allowAutoLogin'        =>  true,
		),*/

		/*'urlManager'            =>  array(
			'urlFormat'             =>  'path',
			'rules'                 =>  array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),*/


		'db'                    =>  array(
			'connectionString'      =>  'mysql:host=localhost;dbname=airmate',
			'emulatePrepare'        =>  true,
			'username'              =>  'root',
			'password'              =>  '19840217',
			'charset'               =>  'utf8',
		),

		'errorHandler'          =>  array(
			// use 'site/error' action to display errors
            'errorAction'           =>  'site/error',
        ),
		/*'log'                   =>  array(
			'class'                 =>  'CLogRouter',
			'routes'                =>  array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),

				array(
					'class'=>'CWebLogRoute',
				),

			),
		),*/
        'clientScript'          =>  array(
            'packages'              =>  array(
                'js'                    =>  array(
                    'basePath'              =>  'webroot.javascript',
                    'baseUrl'               =>  'javascript',
                    'js'                    =>  array('validate.js', 'area.js', 'simulateSelector.js'),
                    'depends'               =>  array('jquery')
                ),
                'css'                   =>  array(
                    'basePath'              =>  'webroot.css',
                    'baseUrl'               =>  'css',
                    'css'                   =>  array('base.css')
                )
            )
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'                =>  array(
		// this is used in contact page
		'adminEmail'            =>  '50674@airmate-china.net',
        'contactPhone'          =>  '0755-27655988-8112',
        'quantity'              =>  1,
        'times'                 =>  1
	),
);