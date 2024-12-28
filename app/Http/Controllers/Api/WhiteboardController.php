<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteWhiteboardParticipantRequest;
use App\Http\Requests\StoreWhiteboardParticipantRequest;
use App\Http\Requests\StoreWhiteboardRequest;
use App\Http\Requests\UpdateWhiteboardRequest;
use App\Models\Whiteboard;
use App\Models\User;
use Illuminate\Http\Request;

class WhiteboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Whiteboard::class);
        $whiteboards = Whiteboard::with('participants')
            ->where('user_id', auth()->id())
            ->orWhereHas('participants', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->get();
        return response()->json($whiteboards);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWhiteboardRequest $request)
    {
        $whiteboard = Whiteboard::create([
            ...$request->validated(),
            'user_id' => auth()->id(),
        ]);
        return response()->json($whiteboard, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Whiteboard $whiteboard)
    {
        $this->authorize('view', $whiteboard);
        return response()->json($whiteboard->load('participants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWhiteboardRequest $request, Whiteboard $whiteboard)
    {
        $whiteboard->update($request->validated());

        return response()->json($whiteboard);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Whiteboard $whiteboard)
    {
        $this->authorize('delete', $whiteboard);
        $whiteboard->delete();

        return response()->noContent();
    }

    public function addParticipant(StoreWhiteboardParticipantRequest $request, Whiteboard $whiteboard)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        $whiteboard->participants()->syncWithoutDetaching([$user->id]);

        return response()->json(['message' => 'Participant added', 'user' => $user]);
    }

    public function removeParticipant(DeleteWhiteboardParticipantRequest $request, Whiteboard $whiteboard)
    {
        $whiteboard->participants()->detach($request->userId);
        return response()->json(['message' => 'Participant removed']);
    }
}
