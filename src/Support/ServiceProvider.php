<?php

namespace Salvacheung\Container\Support;

abstract class ServiceProvider
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }
}