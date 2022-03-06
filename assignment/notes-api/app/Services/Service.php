<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class Service
{
    /**
     * @param Builder $query
     * @param $filters
     * @return LengthAwarePaginator
     */
    protected function getQueryWithAppliedPaginationFromParams(Builder $query, $filters): LengthAwarePaginator
    {
        $pageSize = $filters['per_page'] ?? 10;
        $page = $filters['page'] ?? 1;

        return $query->paginate($pageSize, ['*'], 'page', $page);
    }

    /**
     * @param Builder $query
     * @param $filters
     * @return Builder
     */
    protected function getQueryWithAppliedOrderFromParams(Builder $query, $filters): Builder
    {
        $orderDirection = $filters['order_direction'] ?? 'ASC';
        $orderAttribute = $filters['order_by'] ?? null;

        if ($orderAttribute) {
            $query->orderBy($orderAttribute, $orderDirection);
        }

        return $query;
    }
}
