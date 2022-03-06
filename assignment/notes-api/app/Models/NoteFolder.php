<?php

namespace App\Models;

use App\Traits\HasFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin Builder
 */
class NoteFolder extends Model
{
    use HasFactory, HasFilter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    /**
     * @return \string[][]
     */
    public static function getFormRules()
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }

    /**
     * @return BelongsToMany
     */
    public function notes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class, 'notes_note_folders');
    }
}
