kohana2-cache-mongo
===================

MongoDB-based cache driver for the Kohana v2.x PHP Framework, with tags support.

## Requirements ##

- PHP 5.2+
- php-mongo (offical MongoDB extension for PHP, http://www.php.net/manual/en/book.mongo.php)
- a running MongoDB instance.

## Installation ##
	
*Option 1*
- Just copy the driver file to librares/drivers/Cache, and copy the config content to config/cache.php 
- Don't forget honoring the Kohana v2 hierarchical directory structure.

*Option 2*
- Use this as a project as a module, enabling it in config.php (using MODPATH.'kohana2-cache-mongo')

## Configuration ##

Open the config/cache.php file and configure MongoDB's host and port (localhost:27017 is the default), and (optionally) database and collection. 

## Usage ##

This should be transparent if you're already familiar with Kohana's caching system.
	
	$cache = Cache::instance('mongo');
	$cache->set( ... ); // Cache an item
	$cache->get('some-id'); // Get a cached item
	$cache->delete('some-id'); // Delete a cached item
	$cache->delete_tag('some-tag'); // Delete all items with a certain tag
	
For more information, check Kohana v2's caching interface: http://docs.kohanaphp.com/libraries/cache

## Additional tips ##

- You can configure this as your 'default' cache driver, if you want. 
- You can use multiple configuration sets, using different combinations of databases and collections (or even MongoDB's instances, althout that may be too much). That will allow having multiple cache storages, each one with a specific purpose. You can interact with each one of those storages individually.
