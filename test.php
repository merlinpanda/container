<?php


require __DIR__ . '/vendor/autoload.php';

function api($name = null)
{
    $app = new \Salvacheung\Container\Application();
    if ($name) {
        return $app->make($name);
    } else {
        return $app;
    }
}



$word = api()->version();

var_dump($word);