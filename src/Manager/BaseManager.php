<?php

declare(strict_types=1);

namespace CarlosChininin\AppBundle\Manager;

use CarlosChininin\AppBundle\Entity\EntityInterface;
use CarlosChininin\AppBundle\Repository\RepositoryInterface;
use CarlosChininin\AppUtil\Http\ParamFetcher;

class BaseManager extends AbstractManager
{
    public function __construct(
        protected readonly RepositoryInterface $repository,
    ) {
    }

    public function save(EntityInterface $entity): bool
    {
        $this->repository->save($entity);

        return true;
    }

    public function remove(EntityInterface $entity): bool
    {
        $this->repository->remove($entity);

        return true;
    }

    public function list(ParamFetcher $params, bool $inArray = false): array
    {
        return $this->repository->filter($params, $inArray);
    }
}
