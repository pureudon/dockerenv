<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Datatype;

class DatatypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return "hi index";

        $datatypes = Datatype::orderBy('id','asc')->get();

        return view('datatypes.home', compact(
            'datatypes'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return "hi create";

        $datatype = New Datatype;

        $action = 'create';
        return view('datatypes.edit', compact(
            'datatype',
            'action'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return "hi store";

        $datatype = New Datatype;
        $datatype->save();

        $datatype = $this->store_or_update_core($datatype,$request);
        $datatype->save();

        return redirect()->route('datatypes.show', ['id' => $datatype->id]);
    }

    public function store_or_update_core($datatype, Request $request)
    {
        $datatype = $this->store_or_update_input_core($datatype,$request);
        $datatype = $this->store_or_update_refresh_core($datatype);

        return $datatype;
    }

    public function store_or_update_input_core($datatype, $request)
    {
        $input = $request->all();

        if ($request->exists('varchartype')) { $datatype->varchartype = $request->input('varchartype'); }
        if ($request->exists('inttype')) { $datatype->inttype = $request->input('inttype'); }

        if ($request->exists('yeartype')) { $datatype->yeartype = $request->input('yeartype'); }
        if ($request->exists('datetype')) { $datatype->datetype = $request->input('datetype'); }
        if ($request->exists('datetimetype')) { $datatype->datetimetype = $request->input('datetimetype'); }

        return $datatype;
    }

    public function store_or_update_refresh_core($datatype)
    {
        $datatype->texttype = $datatype->varchartype;
        $datatype->tinytexttype = $datatype->varchartype;
        $datatype->mediumtexttype = $datatype->varchartype;
        $datatype->longtexttype = $datatype->varchartype;

        $datatype->tinyinttype = $datatype->inttype;
        $datatype->smallinttype = $datatype->inttype;
        $datatype->mediumninttype = $datatype->inttype;
        $datatype->biginttype = $datatype->inttype;

        return $datatype;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return "hi show";

        $datatype = Datatype::where('id',$id)->orderBy('id','desc')->firstOrFail();

        return view('datatypes.show', compact(
            'datatype'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return "hi edit";

        $datatype = Datatype::where('id',$id)->orderBy('id','desc')->firstOrFail();

        $action = 'edit';
        return view('datatypes.edit', compact(
            'datatype',
            'action'
        ));
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
        // return "hi update";

        $input = $request->all();

        $datatype = Datatype::findOrFail($id);

        $datatype = $this->store_or_update_core($datatype,$request);
        $datatype->save();

        return redirect()->route('datatypes.show', ['id' => $datatype->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return "hi destroy";

        $datatype = Datatype::where('id',$id)->orderBy('id','desc')->firstOrFail();
        $datatype->delete();

        // return "Destroy done.";
        return redirect()->route('datatypes.index');
    }
}
