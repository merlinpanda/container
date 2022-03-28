<?php

namespace Salvacheung\Container;

use Salvacheung\Container\Container\Container;
use Salvacheung\Container\Notification\Notify;
use Salvacheung\Container\Contracts\Application as ApplicationContract;

class Application extends Container implements ApplicationContract
{
    const VERSION = '0.0.1';

    protected $initBinds = [
        'notify' => [
            'class' => Notify::class
        ]
    ];

    public function __construct()
    {
        $this->registerBaseBinds();
    }

    public function version()
    {
        return static::VERSION;
    }

    protected function registerBaseBinds()
    {
        static::setInstance($this);

        foreach ($this->initBinds as $id => $concrete) {
            $this->injection($id, $concrete);
        }
    }
}