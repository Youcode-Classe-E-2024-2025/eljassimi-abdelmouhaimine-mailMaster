<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MailingList;
use Illuminate\Http\Request;

class MailingListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MailingList::with('subscribers')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        return MailingList::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return MailingList::with('subscribers')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
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
