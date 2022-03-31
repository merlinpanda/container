<?php


require __DIR__ . '/vendor/autoload.php';

use Salvacheung\Container\Application;

class FF {}

class_alias('FF','CC');

function api($name = null)
{
    $app = Application::getInstance();
    if ($name) {
        return $app[$name];
    } else {
        return $app;
    }
}

$version = api()->version(); // return '0.0.1'
var_dump($version);

$aliases = api()->getAliases('FF'); // return ['cc']
var_dump($aliases);

$is_alias = api()->isAlias('FF'); // return false
var_dump($is_alias);

$hello = api('notify')->sayHello(); // return hello
var_dump($hello);
