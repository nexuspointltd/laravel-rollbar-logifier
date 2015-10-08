<?php

return [

	'rollbar' => [
	
		'enabled'  		=> env('LOGIFIER_ROLLBAR_ENABLED', !env('APP_DEBUG')),
		'warning_level' => env('LOGIFIER_ROLLBAR_WARNING_LEVEL', \Monolog\Logger::WARNING),
		'token'    		=> env('LOGIFIER_ROLLBAR_TOKEN'),

	],

];
