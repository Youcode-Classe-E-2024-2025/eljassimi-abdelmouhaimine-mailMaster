<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Subscriber::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:subscribers,email',
            'name' => 'nullable|string|max:255',
        ]);

        $subscriber = Subscriber::create($validated);

        return response()->json($subscriber, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $subscriber = Subscriber::find($id);

        if (!$subscriber) {
            return response()->json(['message' => 'Subscriber not found'], 404);
        }

        return response()->json($subscriber);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $subscriber = Subscriber::find($id);

        if (!$subscriber) {
            return response()->json(['message' => 'Subscriber not found'], 404);
        }

        $validated = $request->validate([
            'email' => 'sometimes|email|unique:subscribers,email,' . $subscriber->id,
            'name' => 'nullable|string|max:255',
        ]);

        $subscriber->update($validated);

        return response()->json($subscriber);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subscriber = Subscriber::find($id);

        if (!$subscriber) {
            return response()->json(['message' => 'Subscriber not found'], 404);
        }

        $subscriber->delete();

        return response()->json(null, 204);
    }
}
