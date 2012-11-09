<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
* MongoDB based Cache driver.
*
* $Id: Cache_Mongo_Driver.php 0 2012-11-09 00:00:00Z sergiokas $
*
* @package    Cache
* @author     sergiokas <dev@sergiokas.com>
* @requires   php-mongo official driver
* @requires   Kohana PHP Framework version 2.x
* @license    http://kohanaphp.com/license.html
*/
class Cache_Mongo_Driver implements Cache_Driver {

	const DEFAULT_DATABASE = 'kohana-cache';
    const DEFAULT_COLLECTION = 'default';

    protected $connection=null;
    protected $database=null;
    protected $collection=null;
    
	/**
	 * Tests that the MongoDB connection is alive and writable.
	 */
	public function __construct($config) {        
        if(empty($config['host']) || empty($config['port']))
            throw new Kohana_Exception('cache.mongo.missing_connection');
        
        if(empty($config['database']))
            $config['database'] = self::DEFAULT_DATABASE;

        if(empty($config['collection']))
            $config['collection'] = self::DEFAULT_COLLECTION;

        // This will throw a MongoConnectionException if it fails.
        	$this->connection = new Mongo("{$config['host']}:{$config['port']}");
        	$this->database = $this->connection->{$config['database']};
        	$this->collection = $this->database->{$config['collection']};
	}
    
    /**
	 * Set a cache item.
	 */
	public function set($id, $data, array $tags = NULL, $lifetime) {
       	$doc = array(
       		'_id' => $id,
       		'data' => $data,
       		'tags' => (!empty($tags)) ? $tags : array(),
       		'lifetime' => ($lifetime!==0) ? $lifetime+time() : 0
       	);
       	return (bool) $this->collection->save($doc);
	}

	/**
	 * Find all of the cache ids for a given tag.
	 */
	public function find($tag) {
		$result = array();
        $cursor = $this->collection->find(array("tags" => $tag));
        foreach($cursor as $doc) {
	        	if(!empty($doc) && !$this->expired($doc)) {
	        		$result[] = $doc['data'];
	        	}        		
        }
        return $result;
	}

	/**
	 * Get a cache item.
	 * Return NULL if the cache item is not found.
	 */
	public function get($id) {
        $doc = $this->collection->findOne(array('_id' => $id));
        return (!empty($doc) && !empty($doc['data']) && !$this->expired($doc)) ? $doc['data'] : NULL;
	}

	/**
	 * Delete cache items by id or tag.
	 */
	public function delete($id, $tag = FALSE) {
		$query = ($tag) ? array('tags' => $id) : array('_id' => $id);
    		$this->collection->remove($query);
    		return true;
	}

	/**
	 * Deletes all expired cache items.
	 */
	public function delete_expired() {
		$query = array('lifetime'=>array('$lte' => time(), '$gt' => 0));
        $this->collection->remove($query);
        return true;
	}
	
	/**
	 * Check if the current cache element is expired
	 * @param document $doc
	 */
	protected function expired($doc) {
		return (!empty($doc['lifetime']) && ((int)$doc['lifetime']) <= time());
	}

} // End Cache Driver

