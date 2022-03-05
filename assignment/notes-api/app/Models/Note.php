<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class Note extends Model
{
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

    protected $casts = [
        'is_public' => 'boolean'
    ];


    public static function getFormRules(){
        return [
            'title' => ['required', 'string'],
            'body' => ['nullable', 'string'],
            'is_public' => ['nullable', 'boolean'],
            'note_type_id' => ['nullable', 'integer'],
        ];
    }
}
