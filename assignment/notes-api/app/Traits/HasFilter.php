<?php


namespace App\Traits;


use App\Utilities\FilterBuilder;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;

/**
 * @mixin Builder
 * @mixin Scope
 */
trait HasFilter
{
    /**
     * @param $query
     * @param $filters
     * @return mixed
     */
    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\NoteFilters';
        $filter = new FilterBuilder($query, $filters, $namespace);

        return $filter->apply();
    }
}
