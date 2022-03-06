<?php


namespace App\Utilities\NoteFilters;


use App\Utilities\FilterContract;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Folder implements FilterContract
{
    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function handle($value = null): void
    {
        $this->query->whereHas('folders', function ($q) use ($value) {
            return $q->where('note_folders.title', 'LIKE', sprintf('%%%s%%', $value));
        });
    }
}
