<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Order;
use App\Models\User;

class EmployeeController extends Controller
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
        return view('employee.index')->with('employees', Employee::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'employee_role_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
        ]);

        $newEmployee = new Employee([
            'employee_role_id' => $request->employee_rold_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        $newEmployee->save();

        $user = User::where('name', $request->username)->get();
        $newEmployee->username()->attach($user->id);
        return redirect()->route('employee.index')->with('success', 'Employee created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return view('employee.show')->with('employee', Employee::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        return view('employee.edit')->with('employee', Order::find($id));
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
        $oldEmployee = Employee::find($id);

        $employee_role_id = $request->employee_rold_id;
        if ($employee_role_id) $oldEmployee->employee_role_id = $employee_role_id;

        $first_name = $request->first_name;
        if ($first_name) $oldEmployee->first_name = $first_name;

        $last_name = $request->last_name;
        if ($last_name) $oldEmployee->last_name = $last_name;

        $oldEmployee->update();

        return redirect()->route('employee.index')->with('success', 'Employee save successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::find($id)->delete();

        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully');
    }
}
