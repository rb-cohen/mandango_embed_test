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

$comments = $article->getComments()->all();
$comment = array_shift($comments);

$article->removeComments($comment);
$article->save();