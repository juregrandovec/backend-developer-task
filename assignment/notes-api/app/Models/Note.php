<?php

namespace App\Models;

use App\Traits\HasFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Scope;

/**
 * @mixin Builder
 * @mixin Scope
 */
class Note extends Model
{
    use HasFilter, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'body',
        'is_public',
        'note_type_id',
        'user_id',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'is_public' => 'boolean'
    ];

    /**
     * @return \string[][]
     */
    public static function getFormRules()
    {
        return [
            'title' => ['required', 'string'],
            'body' => ['nullable', 'string'],
            'is_public' => ['nullable', 'boolean'],
            'note_type_id' => ['nullable', 'integer'],
        ];
    }

    /**
     * @return BelongsToMany
     */
    public function folders(): BelongsToMany
    {
        return $this->belongsToMany(NoteFolder::class, 'notes_note_folders');
    }

    public function type(): HasOne
    {
        return $this->hasOne(NoteType::class, 'id', 'note_type_id');
    }
}
