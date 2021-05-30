<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use App\Models\ConstantMessages;

class TableController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'verified']);
        $this->middleware('can:tables.index')->only('index');
        $this->middleware('can:tables.show')->only('show');
        $this->middleware('can:tables.create')->only('create');
        $this->middleware('can:tables.edit')->only('edit');
        $this->middleware('can:tables.destroy')->only('destroy');
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
        return redirect()->route('tables.index')->with('success', 'Table created succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('table.show')->with('table', Table::find($id));
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

        return redirect()->route('tables.index')->with('success', 'Table saved succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Table::find($id)->delete();

        return redirect()->route('tables.index')->with('success', 'Table deleted succesfully');
    }
}
