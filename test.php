<?php


require __DIR__ . '/vendor/autoload.php';

use Salvacheung\Container\Application;

function api($name = null)
{
    $app = Application::getInstance();
    if ($name) {
        return $app[$name];
    } else {
        return $app;
    }
}



$word = api()->version();


var_dump($word);