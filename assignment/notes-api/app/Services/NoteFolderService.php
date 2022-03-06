<?php


namespace App\Services;


use App\Models\NoteFolder;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class NoteFolderService extends Service
{
    /**
     * @param array $payload
     * @return NoteFolder
     * @throws Exception
     */
    public function createNewNoteFolderFromPayload(array $payload): NoteFolder
    {
        $noteFolder = new NoteFolder($payload);
        $result = $noteFolder->save();

        if (!$result) {
            throw new Exception();
        }

        return $noteFolder;
    }

    /**
     * @param int $id
     * @param array $payload
     * @return NoteFolder
     * @throws Exception
     */
    public function updateNoteFolderFromPayload(int $id, array $payload): NoteFolder
    {
        $noteFolder = NoteFolder::where('id', $id)->first();
        $noteFolder->fill($payload);
        $result = $noteFolder->save();

        if (!$result) {
            throw new Exception();
        }

        return $noteFolder;
    }

    /**
     * @param $id
     * @return bool|null
     */
    public function deleteNoteFolder($id): bool|null
    {
        return NoteFolder::where('id', $id)->where('user_id', auth()->user()->id)->delete();
    }

    /**
     * @param $id
     * @return Builder|Model
     */
    public function getNoteFolder($id): Builder|Model
    {
        return NoteFolder::with('notes')->where('id', $id)->where('user_id', auth()->user()->id)->firstOrFail();
    }

    /**
     * @param $filters
     * @return LengthAwarePaginator
     */
    public function getNoteFolders($filters): LengthAwarePaginator
    {
        $query = NoteFolder::with('notes')->where('user_id', auth()->user()->id)->filterBy($filters);
        $query = $this->getQueryWithAppliedOrderFromParams($query, $filters);

        return $this->getQueryWithAppliedPaginationFromParams($query, $filters);
    }
}
