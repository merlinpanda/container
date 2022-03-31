<?php

namespace Salvacheung\Container\Contracts;

use Psr\Container\ContainerInterface;

interface Container extends ContainerInterface
{
    public function isAlias(string $class): bool;

    public function getAliases(string $class): ?array;
}