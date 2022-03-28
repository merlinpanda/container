<?php

namespace Salvacheung\Container\Contracts;

use Psr\Container\ContainerExceptionInterface;
use Throwable;

class ContainerException implements ContainerExceptionInterface
{

    /**
     * ----------------------------------------------
     *
     * ----------------------------------------------
     *
     *
     * @return string
     * @author Salva Cheung <salva.cheung@outlook.com>
     */
    public function getMessage(): string
    {
        // TODO: Implement getMessage() method.
    }

    /**
     * ----------------------------------------------
     *
     * ----------------------------------------------
     *
     *
     * @return int
     * @author Salva Cheung <salva.cheung@outlook.com>
     */
    public function getCode()
    {
        // TODO: Implement getCode() method.
    }

    /**
     * ----------------------------------------------
     *
     * ----------------------------------------------
     *
     *
     * @return string
     * @author Salva Cheung <salva.cheung@outlook.com>
     */
    public function getFile(): string
    {
        // TODO: Implement getFile() method.
    }

    /**
     * ----------------------------------------------
     *
     * ----------------------------------------------
     *
     *
     * @return int
     * @author Salva Cheung <salva.cheung@outlook.com>
     */
    public function getLine(): int
    {
        // TODO: Implement getLine() method.
    }

    /**
     * ----------------------------------------------
     *
     * ----------------------------------------------
     *
     *
     * @return array
     * @author Salva Cheung <salva.cheung@outlook.com>
     */
    public function getTrace(): array
    {
        // TODO: Implement getTrace() method.
    }

    /**
     * ----------------------------------------------
     *
     * ----------------------------------------------
     *
     *
     * @return string
     * @author Salva Cheung <salva.cheung@outlook.com>
     */
    public function getTraceAsString(): string
    {
        // TODO: Implement getTraceAsString() method.
    }

    /**
     * ----------------------------------------------
     *
     * ----------------------------------------------
     *
     *
     * @return Throwable|null
     * @author Salva Cheung <salva.cheung@outlook.com>
     */
    public function getPrevious()
    {
        // TODO: Implement getPrevious() method.
    }

    /**
     * ----------------------------------------------
     *
     * ----------------------------------------------
     *
     *
     * @return string
     * @author Salva Cheung <salva.cheung@outlook.com>
     */
    public function __toString()
    {
        // TODO: Implement __toString() method.
    }
}