kohana2-cache-mongo
===================

MongoDB-based cache driver for the Kohana v2.x PHP Framework, with tags support.

## Requirements ##

- PHP 5.2+
- Offical MongoDB extension for PHP, http://www.php.net/manual/en/book.mongo.php
- A running MongoDB instance, and a working Kohana 2.x installation.

## Installation ##
	
**Option 1**
- Just copy the driver file to **librares/drivers/Cache**, and copy the config content to **config/cache.php** 
- Don't forget honoring the Kohana v2 hierarchical directory structure.

**Option 2**
- Use this as a project module, enabling it in **config/config.php** (using MODPATH.'kohana2-cache-mongo')

## Configuration ##

- Open the **config/cache.php** file and configure MongoDB's host and port (localhost:27017 is the default)
- Optionally, configure a specific database and collection. 

## Usage ##

This should be transparent if you're already familiar with Kohana's caching system.

```php	
$cache = Cache::instance('mongo');
$cache->set( ... ); // Cache an item
$cache->get('some-id'); // Get a cached item, null if not found
$cache->delete('some-id'); // Delete a cached item
$cache->delete_tag('some-tag'); // Delete all items with a certain tag
```
	
For more information, check Kohana v2's caching interface: http://docs.kohanaphp.com/libraries/cache

## Additional tips ##

- You can configure this module as your 'default' cache driver, if you want. 
- You can use multiple configuration sets, using different combinations of databases and collections (or even MongoDB instances, though that may be too much). That will allow having multiple cache storages, each one with a specific purpose. You can interact with each one of those storages individually.

## Aftermath ##

Drop me a line if you find this useful, I'd like to know: *dev at sergiokas dot com*
