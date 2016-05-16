<?php
	require_once "vendor/autoload.php";
	$es= Elasticsearch\ClientBuilder::create()->build(['hosts'=>['localhost:9200']]);
	//connection to redis
	//PECL extension is used to communicate with Redis server
	$redis = new Redis();
	$redis->connect('127.0.0.1',6379);
	//echo $redis->ping();
?>