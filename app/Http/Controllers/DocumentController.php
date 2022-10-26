<?php

namespace App\Http\Controllers;

use App\Http\Resources\Media;
use App\Http\Resources\Document as DocumentResource;
use App\Models\Document;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Vehicle $vehicle)
    {
      return $vehicle->documents;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Vehicle $vehicle)
    {
      $request->validate([
        'file'  => 'required|file|max:5000',
        'type'  => 'required|string',
      ]);

      $oldFile = Document::where('vehicle_id', $vehicle->id)->where('type', $request->type)->first();
      if( $oldFile ) $oldFile->delete();

      $data = array_merge($request->only(['expires_at', 'type']), ['vehicle_id'=>$vehicle->id]);
      $document = Document::create($data);
      $file = $document->addMedia( $request->file('file') )->toMediaCollection('file');
      return new Media($file);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
      $document->delete();
      return new DocumentResource($document);
    }
}
