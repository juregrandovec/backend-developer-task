<?php

namespace App\Http\Requests\NoteRequests;

use App\Models\Note;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $noteId = $this->route('note');

        return (bool)Note::where("id", $noteId)->where('user_id', auth()->user()->id)->first();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Note::getFormRules();
    }
}
