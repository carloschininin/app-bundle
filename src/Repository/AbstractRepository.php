<?php

declare(strict_types=1);

/*
 * This file is part of the PIDIA
 * (c) Carlos Chininin <cio@pidia.pe>
 */

namespace CarlosChininin\AppBundle\Repository;

use CarlosChininin\AppBundle\Entity\EntityInterface;
use CarlosChininin\AppUtil\Http\ParamFetcher;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;

abstract class AbstractRepository extends ServiceEntityRepository implements RepositoryInterface
{
    /** @return EntityInterface[]|array */
    public function filter(ParamFetcher $params, bool $inArray = false, array $options = []): array
    {
        $queryBuilder = $this->filterQuery($params, $options)->getQuery();

        return true === $inArray ? $queryBuilder->getArrayResult() : $queryBuilder->getResult();
    }

    /** @return EntityInterface[]|array */
    public function all(bool $inArray = false): array
    {
        $queryBuilder = $this->allQuery()->getQuery();

        return true === $inArray ? $queryBuilder->getArrayResult() : $queryBuilder->getResult();
    }

    public function save(EntityInterface $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function remove(EntityInterface $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    abstract public function filterQuery(ParamFetcher $params, array $options = []): QueryBuilder;

    abstract public function allQuery(): QueryBuilder;
}
