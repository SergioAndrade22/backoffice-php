<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Order;
use App\Models\Table;
use App\Models\ConstantMessages;
use Carbon\Carbon;
use Exception;

class OrderController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'verified']);
        $this->middleware('can:orders.index')->only('index');
        $this->middleware('can:orders.show')->only('show');
        $this->middleware('can:orders.create')->only('create');
        $this->middleware('can:orders.edit')->only('edit');
        $this->middleware('can:orders.destroy')->only('destroy');
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
            'items' => 'required',
        ]);
        try {
            $newOrder = new Order([
                'date' => Carbon::now(),
                'table_id' => $request->table_id
            ]);
    
            $newOrder->save();

            $totalCost = 0;
            foreach($request->items as $item) {
                $newOrder->items()->attach($item['id'], ['order_id'=> $newOrder->id, 'amount'=> $item['amount']]);
                $totalCost += $item['cost'];
            }

            $newOrder->total_cost = $totalCost;

            $newOrder->save();

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
            $request->validate([
                'table_id' => 'required',
                'items' => 'required',
            ]);

            $oldOrder = Order::find($id);
    
            if ($oldOrder) {
                $oldOrder->table_id = $request->table_id;
        
                $oldOrder->items()->detach();

                $totalCost = 0;
                foreach($request->items as $item) {
                    $oldOrder->items()->attach($item['id'], ['order_id'=> $oldOrder->id, 'amount'=> $item['amount']]);
                    $totalCost += $item['cost'];
                }

                $oldOrder->total_cost = $totalCost;

                $oldOrder->save();

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
                $order->items()->detach();
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
