<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Subscribers",
 *     description="API Endpoints for Managing Subscribers"
 * )
 */
class SubscriberController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/subscribers",
     *     summary="Get list of subscribers",
     *     tags={"Subscribers"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of subscribers",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Subscriber")
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function index()
    {
        return response()->json(Subscriber::all(), 200);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:subscribers,email',
            'name' => 'nullable|string|max:255',
        ]);

        $subscriber = Subscriber::create($validated);

        return response()->json($subscriber, 201);
    }

    public function show($id)
    {
        $subscriber = Subscriber::find($id);

        if (!$subscriber) {
            return response()->json(['message' => 'Subscriber not found'], 404);
        }

        return response()->json($subscriber);
    }

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
