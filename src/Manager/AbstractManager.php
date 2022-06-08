<?php

declare(strict_types=1);

/*
 * This file is part of the PIDIA
 * (c) Carlos Chininin <cio@pidia.pe>
 */

namespace CarlosChininin\AppBundle\Manager;

use CarlosChininin\AppUtil\Error\ErrorDto;

abstract class AbstractManager
{
    /** @var ErrorDto[]|array */
    private array $errors;

    public function addError(ErrorDto $error): void
    {
        $this->errors[] = $error;
    }

    /** @return ErrorDto[] */
    public function errors(): array
    {
        $errors = $this->errors;
        unset($this->errors);

        return $errors;
    }
}
