<?php

declare(strict_types=1);

namespace CarlosChininin\AppBundle\Doctrine\Pagination;

use CarlosChininin\AppUtil\Pagination\PaginatedData;
use CarlosChininin\AppUtil\Pagination\PaginationDto;
use CarlosChininin\AppUtil\Pagination\PaginationInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\CountWalker;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineOrmPaginator;
use Exception;

class DoctrinePagination implements PaginationInterface
{
    public function paginate(mixed $data, PaginationDto $pagination): PaginatedData
    {
        if (!$data instanceof QueryBuilder) {
            throw new DoctrinePaginationException('Query no valido');
        }

        $limit = $pagination->limit();
        $firstResult = ($pagination->page() - 1) * $limit;
        $query = $data
            ->setFirstResult($firstResult)
            ->setMaxResults($limit)
            ->getQuery();

        if (0 === \count($data->getDQLPart('join'))) {
            $query->setHint(CountWalker::HINT_DISTINCT, false);
        }

        $paginator = new DoctrineOrmPaginator($query, true);

        $useOutputWalkers = \count($data->getDQLPart('having') ?: []) > 0;
        $paginator->setUseOutputWalkers($useOutputWalkers);
        try {
            $results = iterator_to_array($paginator->getIterator());
            $count = $paginator->count();
        } catch (Exception) {
            $results = [];
            $count = 0;
        }

        return PaginatedData::create($results, $count, $pagination);
    }

    public static function data(mixed $data, PaginationDto $pagination): PaginatedData
    {
        return (new self())->paginate($data, $pagination);
    }
}
