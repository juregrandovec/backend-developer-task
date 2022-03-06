<?php

namespace App\Http\Requests\NoteFolderRequests;

use App\Models\NoteFolder;
use Illuminate\Foundation\Http\FormRequest;

class CreateNoteFolderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
