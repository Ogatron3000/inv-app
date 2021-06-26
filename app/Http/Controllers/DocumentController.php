<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use App\Models\UserEquipment;
use App\Models\Equipment;
use App\Models\User;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::all();
        $content_header = "Documents list";
        $breadcrumbs = [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => 'Documents list', 'link' => '/documents' ],
        ];
        return view('documents.index', compact(['documents', 'content_header', 'breadcrumbs']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $content_header = "Add New Document";
        $breadcrumbs = [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => 'Documents list', 'link' => '/documents' ],
            [ 'name' => 'New Document', 'link' => '/documents/create' ],
        ];
        return view('documents.create', compact(['users', 'content_header', 'breadcrumbs']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentRequest $request)
    {
        $request->merge(['admin_id' => auth()->id() ]);
        Document::query()->create($request->all());
        return redirect(route('documents.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        $users = User::all();
        $equipment = Equipment::query()->available()->get();
        $items = $document->items;
        $content_header = "Document details";
        $breadcrumbs = [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => 'Document list', 'link' => '/documents' ],
            [ 'name' => 'Document details', 'link' => '/users/'.$document->id ],
        ];
        return view('documents.show', compact(['content_header', 'breadcrumbs', 'document', 'users', 'items', 'equipment']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        $users = User::all();
        $equipment = Equipment::query()->available()->get();
        $items = $document->items;
        $content_header = "Document details";
        $breadcrumbs = [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => 'Document list', 'link' => '/documents' ],
            [ 'name' => 'Document details', 'link' => '/users/'.$document->id ],
        ];
        return view('documents.edit', compact(['content_header', 'breadcrumbs', 'document', 'users', 'items', 'equipment']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DocumentRequest  $request
     * @param  \App\Models\Document                $document
     *
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentRequest $request, Document $document)
    {
        $request->merge(['admin_id' => auth()->id() ]);
        $document->update($request->all());
        return redirect()->route('documents.show', $document->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }
}
