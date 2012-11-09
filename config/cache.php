<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * MongoDB-based cache configuration
 */
$config['mongo'] = array(
		'driver'   => 'mongo',
		// MongoDB connection information
		'params'   => array(
			'host' => '127.0.0.1',
			'port' => '27017',
			'database' => 'kohana-mongo-cache'
			'collection' => null // Leave null for default collection
		),
		// Cache lifetime, in seconds and requests
		'lifetime' => 1800,
		'requests' => 1000
);
