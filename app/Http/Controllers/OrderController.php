<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Table;

class OrderController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('order.index')->with('orders', Order::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'table_id' => 'required',
            'total_cost' => 'required',
            'items' => 'required',
        ]);

        $newOrder = new Order([
            'total_cost' => $request->total_cost,
        ]);

        $newOrder->save();

        $table = Table::where('id', $request->table_id)->get();
        $newOrder->table()->attach($table->id);

        $newOrder->items()->attach(array_map($this->getIdFunc, $request->items));
        return redirect()->route('orders.index')->with('success', 'Order created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return view('order.show')->with('order', Order::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        return view('order.edit')->with('order', Order::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $oldOrder = Order::find($id);

        $totalCost = $request->total_cost;
        if ($totalCost) {
            $oldOrder->total_cost = $totalCost;
            $oldOrder->update();
        }

        $tableId = $request->table_id;
        if ($tableId){
            $table = Table::where('id', $tableId)->get();
            $oldOrder->table()->dettach($tableId);
            $oldOrder->table()->attach($table->id);
        }

        $items = $request->items;
        if ($items){
            $oldItemsIds = array_map($this->getIdFunc, $oldOrder->items()->get());
            $oldOrder->detach($oldItemsIds);

            $newItemsIds = array_map($this->getIdFunc, $items);
            $oldOrder->attach($newItemsIds);
        }        

        return redirect()->route('orders.index')->with('success', 'Order saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Order::find($id)->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }

    private function getIdFunc($item) {
        return $item->id;
    }
}
