<?php

namespace App\Http\Controllers;

use App\Http\Resources\WriterCollection;
use App\Http\Resources\WriterResource;
use App\Models\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WriterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $writers =Writer::all();
        return new WriterCollection($writers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $writer = Writer::create([
            'name' => $request->name,
            'country' => $request->country,
            'gender'=>$request->gender,            
        ]);

        return new WriterResource($writer);
    }

    /**
     * Display the specified resource.
     */
    public function show(Writer $writer)
    {
        return new WriterResource($writer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Writer $writer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Writer $writer)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'gender' => 'required|string',           
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $writer->name = $request->name;
        $writer->country = $request->country;
        $writer->gender = $request->gender;        
 
        $writer->update();
        return response()->json(['Writer updated successfully', new WriterResource($writer)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Writer $writer)
    {
        $writer->delete();
        return response()->json('Writer deleted successfully');
    }
}
