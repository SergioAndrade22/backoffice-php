<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'verified']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('table.index')->with('tables', Table::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('table.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'people' => 'required',
        ]);

        $newTable = new Table;
        $newTable->people = $request->people;

        $description = $request->description;
        if ($description) $newTable->description = $description;

        $newTable->save();
        return redirect()->route('table.index')->with('success', 'Table created succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('table.show')->with('order', Table::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('table.edit')->with('table', Table::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $oldTable = Table::find($id);

        $people = $request->people;
        if ($people) $oldTable->people = $people;

        $description = $request->description;
        if ($description) $oldTable->description = $description;

        $oldTable->update();

        return redirect()->route('table.index')->with('success', 'Table saved succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Table::find($id)->delete();

        return redirect()->route('index.index')->with('success', 'Table deleted succesfully');
    }
}
