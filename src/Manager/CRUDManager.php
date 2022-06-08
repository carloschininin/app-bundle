<?php

declare(strict_types=1);

/*
 * This file is part of the PIDIA
 * (c) Carlos Chininin <cio@pidia.pe>
 */

namespace CarlosChininin\AppBundle\Manager;

use CarlosChininin\AppBundle\Repository\AbstractRepository;
use CarlosChininin\AppUtil\Http\ParamFetcher;
use CarlosChininin\AppUtil\Pagination\PaginatedData;
use CarlosChininin\AppUtil\Pagination\PaginationDto;
use CarlosChininin\AppUtil\Pagination\PaginationInterface;

class CRUDManager extends BaseManager
{
    public function __construct(
        protected readonly PaginationInterface $pagination,
        AbstractRepository $repository,
    ) {
        parent::__construct($repository);
    }

    public function listPaginate(int $page, ParamFetcher $params): PaginatedData
    {
        $limit = $params->getNullableInt(PaginationDto::LIMIT_NAME);
        $pagination = PaginationDto::create($page, $limit);
        $query = $this->repository->filterQuery($params);

        return $this->pagination->paginate($query, $pagination);
    }
}
