<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use App\Models\ConstantMessages;
use Exception;

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
        try{
            return view('table.index')->with('tables', Table::all());
        } catch (Exception) {
            return view('dashboard')->with(ConstantMessages::errorResult, ConstantMessages::internalErrorMessage);
        }
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
            'description' => 'required'
        ]);

        try{
            $newTable = new Table([
                'people' => $request->people,
                'description' => $request->description,
            ]);
            $newTable->save();

            return redirect()->route('tables.index')->with(ConstantMessages::successResult, ConstantMessages::successMessage('Table', 'created'));
        } catch(Exception) {
            return redirect()->route('tables.index')->with(ConstantMessages::errorResult, ConstantMessages::internalErrorMessage);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $table = Table::find($id);
            if ($table) {
                return view('table.show')->with('table', $table);
            } else {
                return redirect()->route('tables.index')->with(ConstantMessages::errorResult, ConstantMessages::invalidIdMessage);
            }
        } catch(Exception) {
            return redirect()->route('tables.index')->with(ConstantMessages::errorResult, ConstantMessages::internalErrorMessage);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $table = Table::find($id);
            if ($table) {
                return view('table.edit')->with('table', $table);
            } else {
                return redirect()->route('tables.index')->with(ConstantMessages::errorResult, ConstantMessages::invalidIdMessage);
            }
        } catch(Exception) {
            return redirect()->route('tables.index')->with(ConstantMessages::errorResult, ConstantMessages::internalErrorMessage);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $request->validate([
            'people' => 'required',
            'description' => 'required'
        ]);

        try {
            $oldTable = Table::find($id);
            if ($oldTable){
                $oldTable->people = $request->people;
                $oldTable->description = $request->description;

                $oldTable->save();
                return redirect()->route('items.index')->with(ConstantMessages::successResult, ConstantMessages::successMessage('Table', 'saved'));
            } else {
                return redirect()->route('items.index')->with(ConstantMessages::errorResult, ConstantMessages::invalidIdMessage);
            }
        } catch(Exception) {
            return redirect()->route('items.index')->with(ConstantMessages::errorResult, ConstantMessages::internalErrorMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $table = Table::find($id);
            if ($table) {
                $table->orders()->detach();
                $table->delete();
                
                return redirect()->route('items.index')->with(ConstantMessages::successResult, ConstantMessages::successMessage('Table', 'deleted'));
            } else {
                return redirect()->route('items.index')->with(ConstantMessages::errorResult, ConstantMessages::invalidIdMessage);
            }
        } catch (Exception) {
            return redirect()->route('items.index')->with(ConstantMessages::errorResult, ConstantMessages::internalErrorMessage);
        }
    }
}
