<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MailingList;
use Illuminate\Http\Request;
/**
 * @OA\Tag(
 *     name="Mailing Lists",
 *     description="API Endpoints for Managing Mailing Lists"
 * )
 */
class MailingListController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/mailing-lists",
     *     tags={"Mailing Lists"},
     *     summary="Get all mailing lists with subscribers",
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of mailing lists",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/MailingList")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return MailingList::with('subscribers')->get();
    }

    /**
     * @OA\Get(
     *     path="/api/mailing-lists",
     *     tags={"Mailing Lists"},
     *     summary="Get all mailing lists with subscribers",
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of mailing lists",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/MailingList")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        return MailingList::create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/mailing-lists/{id}",
     *     tags={"Mailing Lists"},
     *     summary="Get a specific mailing list by ID",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Mailing List ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Mailing list details",
     *         @OA\JsonContent(ref="#/components/schemas/MailingList")
     *     ),
     *     @OA\Response(response=404, description="Not Found")
     * )
     */
    public function show($id)
    {
        return MailingList::with('subscribers')->findOrFail($id);
    }
    /**
     * @OA\Put(
     *     path="/api/mailing-lists/{id}",
     *     tags={"Mailing Lists"},
     *     summary="Update a mailing list",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Mailing List ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Updated Name")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Updated mailing list",
     *         @OA\JsonContent(ref="#/components/schemas/MailingList")
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $list = MailingList::findOrFail($id);
        $list->update($request->all());
        return $list;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return MailingList::destroy($id);
    }
}
