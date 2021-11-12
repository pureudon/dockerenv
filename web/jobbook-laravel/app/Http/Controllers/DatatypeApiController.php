<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Datatype;

// Resource
use App\Http\Resources\DatatypeResource;
use App\Http\Resources\DatatypeCollection;



class DatatypeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new DatatypeCollection(Datatype::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datatype = Datatype::create([
            'varchartype' => $request->varchartype,
            'inttype' => $request->inttype,
            'yeartype' => $request->yeartype,
            'datetype' => $request->datetype,
            'datetimetype' => $request->datetimetype,
        ]);

        // $datatype = New Datatype;
        
        // $datatype->varchartype = $request->varchartype;
        // $datatype->inttype = $request->inttype;
        // $datatype->yeartype = $request->yeartype;
        // $datatype->datetype = $request->datetype;
        // $datatype->datetimetype = $request->datetimetype;
        
        // $datatype->save();

        return new DatatypeResource($datatype);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Datatype $datatype)
    {
        return new DatatypeResource($datatype);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Datatype $datatype)
    {
        // check if currently authenticated user is the owner of the book
        // if ($request->user()->id !== $book->user_id) {
        //     return response()->json(['error' => 'You can only edit your own books.'], 403);
        // }

        $datatype->update($request->only(['varchartype', 'inttype', 'yeartype', 'datetype', 'datetimetype']));

        return new DatatypeResource($datatype);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Datatype $datatype)
    {
        $datatype->delete();

        return response()->json(null, 204);
    }
}
