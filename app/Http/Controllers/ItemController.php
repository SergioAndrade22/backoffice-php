<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ConstantMessages;
use Exception;

class ItemController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'verified']);
        $this->middleware('can:items.index')->only('index');
        $this->middleware('can:items.show')->only('show');
        $this->middleware('can:items.create')->only('create');
        $this->middleware('can:items.edit')->only('edit');
        $this->middleware('can:items.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('item.index')->with('items', Item::all());
        } catch (Exception) {
            return view('dashboard')->with(ConstantMessages::errorResult, ConstantMessages::internalErrorMessage);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('item.create');
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
            'name' => 'required',
            'cuisine' => 'required',
            'cost' => 'required',
        ]);
        
        try{
            $newItem = new Item([
                'name' => $request->name,
                'cuisine' => $request->cuisine,
                'cost' => $request->cost,
                'is_vege' => $request->has('is_vege'),
                'is_vegan' => $request->has('is_vegan'),
                'is_coeliac' => $request->has('is_coeliac'),
                'has_alcohol' => $request->has('has_alcohol'),
            ]);
    
            if ($request->has('picture')) $newItem->picture = base64_encode(file_get_contents($request->file('picture')->path()));
    
            $newItem->save();
            
            return redirect()->route('items.index')->with(ConstantMessages::successResult, ConstantMessages::successMessage('Item', 'created'));
        } catch (Exception) {
            return redirect()->route('items.index')->with(ConstantMessages::errorResult, ConstantMessages::internalErrorMessage);
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
            $item = Item::find($id);
            if ($item) {
                return view('item.show')->with('item', $item); 
            } else {
                return redirect()->route('items.index')->with(ConstantMessages::errorResult, ConstantMessages::invalidIdMessage);
            }
        } catch(Exception) {
            return redirect()->route('items.index')->with(ConstantMessages::errorResult, ConstantMessages::internalErrorMessage);
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
            $item = Item::find($id);
            if ($item) {
                return view('item.edit')->with('item', $item); 
            } else {
                return redirect()->route('items.index')->with(ConstantMessages::errorResult, ConstantMessages::invalidIdMessage);
            }            
        } catch(Exception) {
            return redirect()->route('items.index')->with(ConstantMessages::errorResult, ConstantMessages::internalErrorMessage);
        }        
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
        $request->validate([
            'name' => 'required',
            'cuisine' => 'required',
            'cost' => 'required',
        ]);

        try {
            $oldItem = Item::find($id);
            if ($oldItem) {
                $oldItem->name = $request->name;
                $oldItem->cuisine = $request->cuisine;
                $oldItem->cost = $request->cost;
                $oldItem->is_vege = $request->has('is_vege');
                $oldItem->is_vegan = $request->has('is_vegan');
                $oldItem->is_coeliac = $request->has('is_coeliac');
                $oldItem->has_alcohol = $request->has('has_alcohol');                

                if ($request->has('picture')) $oldItem->picture = base64_encode(file_get_contents($request->file('picture')->path()));
                else $oldItem->picture = base64_encode(file_get_contents(public_path('img/no-picture.png')));

                $oldItem->save();
                return redirect()->route('items.index')->with(ConstantMessages::successResult, ConstantMessages::successMessage('Item', 'saved'));
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
    public function destroy($id)
    {
        try {
            $item = Item::find($id);
            if ($item) {
                $item->delete();
                
                return redirect()->route('items.index')->with(ConstantMessages::successResult, ConstantMessages::successMessage('Item', 'deleted'));
            } else {
                return redirect()->route('items.index')->with(ConstantMessages::errorResult, ConstantMessages::invalidIdMessage);
            }
        } catch (Exception) {
            return redirect()->route('items.index')->with(ConstantMessages::errorResult, ConstantMessages::internalErrorMessage);
        }
    }
}
