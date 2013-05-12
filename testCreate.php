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

$connection->getMongo()->selectCollection('embed_test', 'model_article')->drop();

$comment1 = $mandango->create('Model\Comment');
$comment1->setName('John')
        ->setText('Very good');

$comment2 = $mandango->create('Model\Comment');
$comment2->setName('Julie')
        ->setText('I agree');

$article = $mandango->create('Model\Article');
$article->setTitle('This is a test')
        ->setContent('Lorem ipsum...')
        ->addComments(array($comment1, $comment2))
        ->save();