<?php


namespace App\Services;


use App\Models\Note;
use Illuminate\Database\Eloquent\Collection;

class NoteService
{
    public function createNewNoteFromPayload(array $payload): Note
    {
        $note = new Note($payload);
        $note->save();

        return $note;
    }

    public function updateNoteFromPayload(int $id, array $payload): Note
    {
        $note = Note::where('id', $id)->first();
        $note->fill($payload);
        $note->save();

        return $note;
    }

    public function deleteNote($id): bool|null
    {
        return Note::where('id', $id)->where('user_id', auth()->user()->id)->delete();
    }

    public function getNote($id): Note
    {
        return Note::where('id', $id)->where('user_id', auth()->user()->id)->firstOrFail();
    }

    public function getNotes(): Collection
    {
        return Note::where('user_id', auth()->user()->id)->get();
    }
}
