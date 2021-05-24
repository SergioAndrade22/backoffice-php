<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view('item.index')->with('items', $items);
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
        
        $newItem = new Item([
            'name' => $request->name,
            'cuisine' => $request->cuisine,
            'is_vege' => $request->has('is_vege'),
            'is_vegan' => $request->has('is_vegan'),
            'is_coeliac' => $request->has('is_coeliac'),
            'has_alcohol' => $request->has('has_alcohol'),
            'cost' => $request->cost,
        ]);

        if ($request->has('picture')) $newItem->picture = base64_encode(file_get_contents($request->file('picture')->path()));

        $newItem->save();

        return redirect()->route('items.index')->with('success', 'Item created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('item.show')->with('item', Item::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('item.edit')->with('item', Item::find($id));
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
        $oldItem = Item::find($id);

        $name = $request->name;
        if ($name) $oldItem->name = $name;

        $cuisine = $request->cuisine;
        if ($cuisine) $oldItem->cuisine = $cuisine;

        $is_vege = $request->is_vege;
        if ($is_vege) $oldItem->is_vege = $is_vege;

        $is_vegan = $request->is_vegan;
        if ($is_vegan) $oldItem->is_vegan = $is_vegan;

        $is_coeliac = $request->is_coeliac;
        if ($is_coeliac) $oldItem->is_coeliac = $is_coeliac;

        $has_alcohol = $request->has_alcohol;
        if ($has_alcohol) $oldItem->has_alcohol = $has_alcohol;

        $cost = $request->cost;
        if ($cost) $oldItem->cost = $cost;

        if ($request->has('picture')) $oldItem->picture = base64_encode(file_get_contents($request->file('picture')->path()));
        else $oldItem->picture = base64_encode(file_get_contents(public_path('img/no-picture.png')));

        $oldItem->save();

        return redirect()->route('items.index')->with('success', 'Item saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::find($id)->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully');
    }
}
