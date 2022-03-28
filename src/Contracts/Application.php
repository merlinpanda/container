<?php

namespace Salvacheung\Container\Contracts;

interface Application extends Container
{
    public function version();
}