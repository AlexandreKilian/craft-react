<?php

namespace react\twig;
use Craft;

class SerializerExtension extends \Twig_Extension
{
    private $serializer;
    private $cache = [];

    public function getFunctions()
    {
        return array(
            new \Twig_Function('serialize', array($this, 'serialize')),
        );
    }

    public function serialize($data, $schema = 'entry', $group = 'default') {
        $dir = Craft::getAlias('@config/react');
        $path = $dir . "/$schema.php";
        if(!isset($this->cache[$schema])){
            $this->cache[$schema] = include_once($path);
        }

        $config = $this->cache[$schema];

        $f = $config[$group];
        $result = $f($data);

        return $result;
    }
}