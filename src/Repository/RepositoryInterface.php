<?php

declare(strict_types=1);

/*
 * This file is part of the PIDIA
 * (c) Carlos Chininin <cio@pidia.pe>
 */

namespace CarlosChininin\AppBundle\Repository;

use CarlosChininin\AppBundle\Entity\EntityInterface;
use CarlosChininin\AppUtil\Http\ParamFetcher;

interface RepositoryInterface
{
    /** @return EntityInterface[]|array */
    public function filter(ParamFetcher $params, bool $inArray = false, array $options = []): array;

    /** @return EntityInterface[]|array */
    public function all(bool $inArray = false): array;

    public function save(EntityInterface $entity, bool $flush = true): void;

    public function remove(EntityInterface $entity, bool $flush = true): void;
}
