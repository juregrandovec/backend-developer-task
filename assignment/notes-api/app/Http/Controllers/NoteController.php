<?php


namespace App\Http\Controllers;


use App\Http\Requests\CreateNoteRequest;
use App\Http\Requests\OnlyOwnNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Services\NoteService;

class NoteController extends Controller
{
    public function create(CreateNoteRequest $request, NoteService $noteService)
    {
        $payload = $request->all();

        $payload['user_id'] = auth()->user()->id;

        $note = $noteService->createNewNoteFromPayload($payload);

        return response()->json(['id' => $note->id]);
    }

    public function update($id, UpdateNoteRequest $request, NoteService $noteService)
    {
        $payload = $request->all();

        $note = $noteService->updateNoteFromPayload($id, $payload);

        return response()->json(['id' => $note->id]);
    }

    public function delete($id, OnlyOwnNoteRequest $request, NoteService $noteService)
    {
        $success = $noteService->deleteNote($id);
        return response()->json(['success' => (bool)$success]);
    }

    public function get($id, OnlyOwnNoteRequest $request, NoteService $noteService)
    {
        $note = $noteService->getNote($id);

        return response()->json($note);
    }

    public function list(NoteService $noteService)
    {
        $notes = $noteService->getNotes();

        return response()->json($notes);
    }
}
