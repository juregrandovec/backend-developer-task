<?php


namespace App\Http\Controllers;


use App\Http\Requests\NoteFolderRequests\CreateNoteFolderRequest;
use App\Http\Requests\NoteFolderRequests\OnlyOwnNoteFolderRequest;
use App\Http\Requests\NoteFolderRequests\UpdateNoteFolderRequest;
use App\Services\NoteFolderService;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NoteFolderController extends Controller
{
    /**
     * @param CreateNoteFolderRequest $request
     * @param NoteFolderService $noteService
     * @return JsonResponse
     * @throws Exception
     */
    public function create(CreateNoteFolderRequest $request, NoteFolderService $noteService): JsonResponse
    {
        $payload = $request->all();
        $payload['user_id'] = auth()->user()->id;

        $note = $noteService->createNewNoteFolderFromPayload($payload);

        return response()->json(['id' => $note->id]);
    }

    /**
     * @param $id
     * @param UpdateNoteFolderRequest $request
     * @param NoteFolderService $noteService
     * @return JsonResponse
     * @throws Exception
     */
    public function update($id, UpdateNoteFolderRequest $request, NoteFolderService $noteService): JsonResponse
    {
        $payload = $request->all();

        $note = $noteService->updateNoteFolderFromPayload($id, $payload);

        return response()->json(['id' => $note->id]);
    }

    /**
     * @param $id
     * @param OnlyOwnNoteFolderRequest $request
     * @param NoteFolderService $noteService
     * @return JsonResponse
     */
    public function delete($id, OnlyOwnNoteFolderRequest $request, NoteFolderService $noteService): JsonResponse
    {
        $success = $noteService->deleteNoteFolder($id);

        return response()->json(['success' => (bool)$success]);
    }

    /**
     * @param $id
     * @param OnlyOwnNoteFolderRequest $request
     * @param NoteFolderService $noteService
     * @return JsonResponse
     */
    public function get($id, OnlyOwnNoteFolderRequest $request, NoteFolderService $noteService): JsonResponse
    {
        $note = $noteService->getNoteFolder($id);

        return response()->json($note);
    }

    /**
     * @param Request $request
     * @param NoteFolderService $noteService
     * @return LengthAwarePaginator
     */
    public function list(Request $request, NoteFolderService $noteService): LengthAwarePaginator
    {
        return $noteService->getNoteFolders($request->all());
    }
}
