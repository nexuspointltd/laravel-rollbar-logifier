<?php

return [

	'slack' => [
	
		'enabled'  		=> env('LOGIFIER_SLACK_ENABLED', !env('APP_DEBUG')),
		'warning_level' => env('LOGIFIER_SLACK_WARNING_LEVEL', \Monolog\Logger::WARNING),
		'token'    		=> env('LOGIFIER_SLACK_TOKEN'),
	    'channel'  		=> env('LOGIFIER_SLACK_CHANNEL'),
	    'username'		=> env('LOGIFIER_SLACK_USERNAME'),

	],

];