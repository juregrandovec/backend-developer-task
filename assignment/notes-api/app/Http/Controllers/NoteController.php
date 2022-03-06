<?php


namespace App\Http\Controllers;


use App\Http\Requests\NoteRequests\CreateNoteRequest;
use App\Http\Requests\NoteRequests\OnlyOwnNoteRequest;
use App\Http\Requests\NoteRequests\UpdateNoteRequest;
use App\Services\NoteService;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * @param CreateNoteRequest $request
     * @param NoteService $noteService
     * @return JsonResponse
     * @throws Exception
     */
    public function create(CreateNoteRequest $request, NoteService $noteService): JsonResponse
    {
        $payload = $request->all();
        $payload['user_id'] = auth()->user()->id;

        $note = $noteService->createNewNoteFromPayload($payload);

        return response()->json(['id' => $note->id]);
    }

    /**
     * @param $id
     * @param UpdateNoteRequest $request
     * @param NoteService $noteService
     * @return JsonResponse
     * @throws Exception
     */
    public function update($id, UpdateNoteRequest $request, NoteService $noteService): JsonResponse
    {
        $payload = $request->all();

        $note = $noteService->updateNoteFromPayload($id, $payload);

        return response()->json(['id' => $note->id]);
    }

    /**
     * @param $id
     * @param OnlyOwnNoteRequest $request
     * @param NoteService $noteService
     * @return JsonResponse
     */
    public function delete($id, OnlyOwnNoteRequest $request, NoteService $noteService): JsonResponse
    {
        $success = $noteService->deleteNote($id);

        return response()->json(['success' => (bool)$success]);
    }

    /**
     * @param $id
     * @param OnlyOwnNoteRequest $request
     * @param NoteService $noteService
     * @return JsonResponse
     */
    public function get($id, OnlyOwnNoteRequest $request, NoteService $noteService): JsonResponse
    {
        $note = $noteService->getNote($id);

        return response()->json($note);
    }

    /**
     * @param Request $request
     * @param NoteService $noteService
     * @return LengthAwarePaginator
     */
    public function list(Request $request, NoteService $noteService): LengthAwarePaginator
    {
        return $noteService->getNotes($request->all());
    }
}
