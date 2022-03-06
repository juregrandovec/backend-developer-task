<?php


namespace App\Utilities\NoteFilters;


use App\Utilities\FilterContract;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Type implements FilterContract
{
    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function handle($value = null): void
    {
        $this->query->whereHas('type', function ($q) use ($value) {
            return $q->where('note_types.title', 'LIKE', sprintf('%%%s%%', $value));
        });
    }
}
