<?php

namespace App\Http\Controllers\API;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @OA\Schema(
 *     schema="Newsletter",
 *     type="object",
 *     title="Newsletter",
 *     required={"id", "mailing_list_id", "subject", "content"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="mailing_list_id", type="integer", example=5),
 *     @OA\Property(property="subject", type="string", example="New Feature Launch"),
 *     @OA\Property(property="content", type="string", example="We are excited to share our new feature..."),
 *     @OA\Property(property="sent_at", type="string", format="date-time", example="2025-04-16T12:34:56Z"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-04-15T10:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-04-15T10:30:00Z")
 * )
 */
class NewsletterController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/newsletters",
     *     summary="List all newsletters",
     *     tags={"Newsletter"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Newsletter")
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function index()
    {
        return response()->json(Newsletter::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/api/newsletters",
     *     summary="Create a new newsletter",
     *     tags={"Newsletter"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"mailing_list_id", "subject", "content"},
     *             @OA\Property(property="mailing_list_id", type="integer", example=1),
     *             @OA\Property(property="subject", type="string", example="Exciting Updates!"),
     *             @OA\Property(property="content", type="string", example="Here is the content of the newsletter.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Newsletter created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Newsletter")
     *     ),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'mailing_list_id' => 'required|exists:mailing_lists,id',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $newsletter = Newsletter::create($request->all());

        return response()->json($newsletter, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/newsletters/{id}",
     *     summary="Get a single newsletter",
     *     tags={"Newsletter"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Newsletter ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Newsletter")
     *     ),
     *     @OA\Response(response=404, description="Newsletter not found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function show($id)
    {
        $newsletter = Newsletter::find($id);

        if (!$newsletter) {
            return response()->json(['message' => 'Newsletter not found'], 404);
        }

        return response()->json($newsletter);
    }

    /**
     * @OA\Put(
     *     path="/api/newsletters/{id}",
     *     summary="Update a newsletter",
     *     tags={"Newsletter"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Newsletter ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"mailing_list_id", "subject", "content"},
     *             @OA\Property(property="mailing_list_id", type="integer", example=1),
     *             @OA\Property(property="subject", type="string", example="Updated Subject"),
     *             @OA\Property(property="content", type="string", example="Updated newsletter content.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Newsletter updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Newsletter")
     *     ),
     *     @OA\Response(response=404, description="Newsletter not found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function update(Request $request, $id)
    {
        $newsletter = Newsletter::find($id);

        if (!$newsletter) {
            return response()->json(['message' => 'Newsletter not found'], 404);
        }

        $request->validate([
            'mailing_list_id' => 'required|exists:mailing_lists,id',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $newsletter->update($request->all());

        return response()->json($newsletter);
    }

    /**
     * @OA\Delete(
     *     path="/api/newsletters/{id}",
     *     summary="Delete a newsletter",
     *     tags={"Newsletter"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Newsletter ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Newsletter deleted successfully"
     *     ),
     *     @OA\Response(response=404, description="Newsletter not found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function destroy($id)
    {
        $newsletter = Newsletter::find($id);

        if (!$newsletter) {
            return response()->json(['message' => 'Newsletter not found'], 404);
        }

        $newsletter->delete();

        return response()->json(null, 204);
    }
}
