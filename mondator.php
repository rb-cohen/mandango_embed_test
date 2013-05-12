<?php

require(__DIR__ . '/vendor/autoload.php');

use Mandango\Mondator\Mondator;

$modelDir = __DIR__ . '/src/Model';
$mondator = new Mondator();

// assign the config classes
$mondator->setConfigClasses(array(
    'Model\Comment' => array(
        'isEmbedded' => true,
        'fields' => array(
            'name' => 'string',
            'text' => 'string',
        ),
    ),
    'Model\Article' => array(
        'fields' => array(
            'title' => 'string',
            'content' => 'string',
        ),
        'embeddedsMany' => array(
            'comments' => array('class' => 'Model\Comment'),
        ),
    ),
));

// assign extensions
$mondator->setExtensions(array(
    new Mandango\Extension\Core(array(
        'metadata_factory_class' => 'Model\Mapping\MetadataFactory',
        'metadata_factory_output' => $modelDir . '/Mapping',
        'default_output' => $modelDir,
            )),
));

// process
$mondator->process();