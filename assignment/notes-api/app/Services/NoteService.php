<?php


namespace App\Services;


use App\Models\Note;
use App\Models\NoteFolder;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class NoteService extends Service
{
    /**
     * @param array $payload
     * @return Note
     * @throws Exception
     */
    public function createNewNoteFromPayload(array $payload): Note
    {
        $note = new Note($payload);
        $result = $note->save();

        if (!$result) {
            throw new Exception();
        }

        $this->handleConnectingNoteToNoteFolder($payload, $note);

        return $note;
    }

    /**
     * @param int $id
     * @param array $payload
     * @return Note
     * @throws Exception
     */
    public function updateNoteFromPayload(int $id, array $payload): Note
    {
        $note = Note::where('id', $id)->first();
        $note->fill($payload);
        $result = $note->save();

        if (!$result) {
            throw new Exception();
        }

        $this->handleConnectingNoteToNoteFolder($payload, $note);

        return $note;
    }

    /**
     * @param $id
     * @return bool|null
     */
    public function deleteNote($id): bool|null
    {
        return Note::where('id', $id)->where('user_id', auth()->user()->id)->delete();
    }

    /**
     * @param $id
     * @return Builder|Model
     */
    public function getNote($id): Builder|Model
    {
        return Note::with('folders')->where('id', $id)->where('user_id', auth()->user()->id)->first();
    }

    /**
     * @param $filters
     * @return LengthAwarePaginator
     */
    public function getNotes($filters): LengthAwarePaginator
    {
        $query = Note::with('folders')->where('user_id', auth()->user()->id)->filterBy($filters);
        $query = $this->getQueryWithAppliedOrderFromParams($query, $filters);

        return $this->getQueryWithAppliedPaginationFromParams($query, $filters);
    }

    /**
     * @param Note $note
     * @param int $note_folder_id
     * @return void
     */
    private function connectNoteToNoteFolder(Note $note, int $note_folder_id)
    {
        $noteFolder = NoteFolder::where('id', $note_folder_id)->where('user_id', auth()->user()->id)->first();

        if ($noteFolder) {
            $note->folders()->sync([$note_folder_id]);
        }
    }

    /**
     * @param array $payload
     * @param Note $note
     * @return void
     */
    private function handleConnectingNoteToNoteFolder(array $payload, Note $note): void
    {
        if (isset($payload['note_folder_id'])) {
            $this->connectNoteToNoteFolder($note, $payload['note_folder_id']);
        }
    }
}
