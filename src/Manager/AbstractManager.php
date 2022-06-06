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

    public function addErrors(array $errors): void
    {
        /** @var ErrorDto[] $errors */
        foreach ($errors as $error) {
            $this->addError($error);
        }
    }

    /** @return ErrorDto[] */
    public function errors(): array
    {
        return $this->errors;
    }
}
