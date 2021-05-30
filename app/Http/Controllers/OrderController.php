<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Order;
use App\Models\Table;
use App\Models\ConstantMessages;
use Exception;

class OrderController extends Controller
{
    private function getIdFunction($item) {
        return $item->id;
    }

    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        try{
            return view('order.index')->with('orders', Order::all());
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
        try{
            $items = Item::all();
            $tables = Table::all();
            return view('order.create')->with('items', $items)
                                       ->with('tables', $tables);
        } catch (Exception) {
            return redirect()->route('orders.index')->with(ConstantMessages::errorResult, ConstantMessages::internalErrorMessage);
        }
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

        try {
            $newOrder = new Order([
                'total_cost' => $request->total_cost,
            ]);
    
            $newOrder->save();
    
            $table = Table::where('id', $request->table_id)->get();
            $newOrder->table()->attach($table->id);
            $newOrder->items()->attach(array_map($this->geIdFunction, $request->items));
            return redirect()->route('orders.index')->with(ConstantMessages::successResult, ConstantMessages::successMessage('Order', 'created'));
        } catch (Exception) {
            return redirect()->route('orders.index')->with(ConstantMessages::errorResult, ConstantMessages::internalErrorMessage);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        try {
            $order = Order::find($id);
            if ($order){
                return view('order.show')->with('order', $order);
            } else {
                return redirect()->route('orders.index')->with(ConstantMessages::errorResult, ConstantMessages::invalidIdMessage);
            }
        } catch(Exception) {
            return redirect()->route('orders.index')->with(ConstantMessages::errorResult, ConstantMessages::internalErrorMessage);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        try {
            $order = Order::find($id);
            $items = Item::all();
            $tables = Table::all();
            if ($order){
                return view('order.edit')->with('order', $order)
                                         ->with('items', $items)
                                         ->with('tables', $tables);
            } else {
                return redirect()->route('orders.index')->with(ConstantMessages::errorResult, ConstantMessages::invalidIdMessage);
            }
        } catch(Exception) {
            return redirect()->route('orders.index')->with(ConstantMessages::errorResult, ConstantMessages::internalErrorMessage);
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
        try{
            $oldOrder = Order::find($id);
    
            if ($oldOrder) {
                $totalCost = $request->total_cost;
                if ($totalCost) {
                    $oldOrder->total_cost = $totalCost;
                    $oldOrder->save();
                }
        
                $tableId = $request->table_id;
                if ($tableId){
                    $table = Table::where('id', $tableId)->get();
                    $oldOrder->table()->dettach($tableId);
                    $oldOrder->table()->attach($table->id);
                }
        
                $items = $request->items;
                if ($items){
                    $oldItemsIds = array_map($this->geIdFunction, $oldOrder->items()->get());
                    $oldOrder->detach($oldItemsIds);
        
                    $newItemsIds = array_map($this->geIdFunction, $items);
                    $oldOrder->attach($newItemsIds);
                }        
                $result = ConstantMessages::successResult;
                $message = ConstantMessages::successMessage('Order', 'saved');
            } else {
                $result= ConstantMessages::errorResult;
                $message = ConstantMessages::invalidIdMessage;
            } 
        } catch(Exception) {
            $result = ConstantMessages::errorResult;
            $message = ConstantMessages::internalErrorMessage;
        }
        
        return redirect()->route('orders.index')->with($result, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $order = Order::find($id);
            if ($order) {
                $order->delete();
                $result = ConstantMessages::successResult;
                $message = ConstantMessages::successMessage('Order', 'deleted');
            } else {
                $result= ConstantMessages::errorResult;
                $message = ConstantMessages::invalidIdMessage;
            }
        }  catch (Exception) {
            $result= ConstantMessages::errorResult;
            $message = ConstantMessages::internalErrorMessage;
        }

        return redirect()->route('orders.index')->with($result, $message);
    }
}
