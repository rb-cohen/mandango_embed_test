<?php

namespace Model\Mapping;

class MetadataFactory extends \Mandango\MetadataFactory
{
    protected $classes = array(
        'Model\\Comment' => true,
        'Model\\Article' => false,
    );
}