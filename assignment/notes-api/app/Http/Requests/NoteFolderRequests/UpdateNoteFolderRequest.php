<?php

namespace App\Http\Requests\NoteFolderRequests;

use App\Models\NoteFolder;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNoteFolderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $noteFolderId = $this->route('folder');

        return (bool)NoteFolder::where("id", $noteFolderId)->where('user_id', auth()->user()->id)->first();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return NoteFolder::getFormRules();
    }
}
