<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Newsletter::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mailing_list_id' => 'required|exists:mailing_lists,id',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'sent_at' => 'nullable|date',
        ]);

        $newsletter = Newsletter::create($request->all());

        return response()->json($newsletter, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Newsletter $newsletter)
    {
        return response()->json($newsletter, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Newsletter $newsletter)
    {
        $request->validate([
            'mailing_list_id' => 'sometimes|exists:mailing_lists,id',
            'subject' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'sent_at' => 'nullable|date',
        ]);

        $newsletter->update($request->all());

        return response()->json($newsletter, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
