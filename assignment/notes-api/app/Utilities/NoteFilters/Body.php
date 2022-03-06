<?php


namespace App\Utilities\NoteFilters;


use App\Utilities\FilterContract;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Body implements FilterContract
{
    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function handle($value = null): void
    {
        $this->query->where('body', 'LIKE', sprintf('%%%s%%', $value));
    }
}
