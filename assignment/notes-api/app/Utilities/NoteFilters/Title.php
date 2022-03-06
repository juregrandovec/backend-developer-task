<?php


namespace App\Utilities\NoteFilters;


use App\Utilities\FilterContract;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Title implements FilterContract
{
    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function handle($value = null): void
    {
        $this->query->where('title', 'LIKE', sprintf('%%%s%%', $value));
    }
}
