<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * MongoDB-based cache configuration
 * It's possible to have as many configurations you want for connection, databases and collections, 
 * to use for different caching purposes.
 */
$config['mongo'] = array(
	'driver'   => 'mongo',
	'params'   => array(
		// MongoDB connection information
		'host' => '127.0.0.1',
		'port' => '27017',
		'database' => null,	// Leave blank for default database ("kohana-cache")
		'collection' => null // Leave blank for default collection ("default");
	),
	// Cache lifetime, in seconds and requests
	'lifetime' => 1800,
	'requests' => 1000
);
