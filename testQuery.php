<?php

require(__DIR__ . '/vendor/autoload.php');

use Mandango\Cache\FilesystemCache;
use Mandango\Connection;
use Mandango\Mandango;
use Model\Mapping\MetadataFactory;

$metadataFactory = new MetadataFactory();
$cache = new FilesystemCache(__DIR__ . '/cache');

$connection = new Connection('mongodb://localhost:27017', 'embed_test');

$mandango = new Mandango($metadataFactory, $cache);
$mandango->setConnection('my_connection', $connection);
$mandango->setDefaultConnectionName('my_connection');

$articles = $mandango->getRepository('Model\Article')
        ->createQuery()
        ->all();
$article = array_shift($articles);
var_dump($article->toArray());

$comments = $article->getComments()->all();
array_walk($comments, function($comment) {
            var_dump($comment->toArray());
        });