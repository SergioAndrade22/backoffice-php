<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use App\Models\ConstantMessages;
use Exception;

class EmployeeController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'verified']);
        $this->middleware('can:employees.index')->only('index');
        $this->middleware('can:employees.show')->only('show');
        $this->middleware('can:employees.create')->only('create');
        $this->middleware('can:employees.edit')->only('edit');
        $this->middleware('can:employees.destroy')->only('destroy');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        try{
            return view('employee.index')->with('employees', Employee::all());
        } catch(Exception) {
            return view('dashboard')->with(ConstantMessages::errorResult, ConstantMessages::internalErrorMessage);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        try {
            $users = User::doesntHave('roles')->get();
            return view('employee.create')->with('users', $users)->with('positions', Employee::allPositions());
        } catch (Exception) {
            return redirect()->route('employees.index')->with(ConstantMessages::errorResult, ConstantMessages::internalErrorMessage);
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
            'position' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'user' => 'required',
        ]);

        try {
            $newEmployee = new Employee([
                'position' => $request->employee_position_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]);
    
            $user_name = $request->user_name;
            if ($user_name) {
                $user = User::find('name', $user_name);

                if ($user) {
                    $newEmployee->save();
                    $user->assignRole($newEmployee->getPositionAttribute());
                    $newEmployee->user()->attach($user->id);
                    return redirect()->route('employees.index')->with(ConstantMessages::successResult, ConstantMessages::successMessage('Employee', 'created'));
                } else {

                }
            }
        } catch (Exception) {
            return redirect()->route('employees.index')->with(ConstantMessages::errorResult, ConstantMessages::internalErrorMessage);
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
            $employee = Employee::find($id);
            if ($employee){
                return view('employee.show')->with('employee', $employee);
            } else {
                return redirect()->route('employees.index')->with(ConstantMessages::errorResult, ConstantMessages::invalidIdMessage);
            }
        } catch(Exception) {
            return redirect()->route('employees.index')->with(ConstantMessages::errorResult, ConstantMessages::internalErrorMessage);
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
            $employee = Employee::find($id);
            if ($employee){
                return view('employee.edit')->with('employee', $employee);
            } else {
                return redirect()->route('employees.index')->with(ConstantMessages::errorResult, ConstantMessages::invalidIdMessage);
            }
        } catch(Exception) {
            return redirect()->route('employees.index')->with(ConstantMessages::errorResult, ConstantMessages::internalErrorMessage);
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
        try{
            $oldEmployee = Employee::find($id);
    
            if ($oldEmployee) {
                $position = $request->employee_rold_id;
                if ($position) $oldEmployee->setPositionAttribute($position);
        
                $first_name = $request->first_name;
                if ($first_name) $oldEmployee->first_name = $first_name;
        
                $last_name = $request->last_name;
                if ($last_name) $oldEmployee->last_name = $last_name;
        
                $oldEmployee->save();
                $result = ConstantMessages::successResult;
                $message = ConstantMessages::successMessage('Employee', 'saved');
            } else {
                $result= ConstantMessages::errorResult;
                $message = ConstantMessages::invalidIdMessage;
            } 
        } catch(Exception) {
            $result = ConstantMessages::errorResult;
            $message = ConstantMessages::internalErrorMessage;
        }
        
        return redirect()->route('employees.index')->with($result, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $employee = Employee::find($id);
            if ($employee) {
                $employee->delete();
                $result = ConstantMessages::successResult;
                $message = ConstantMessages::successMessage('Employee', 'deleted');
            } else {
                $result= ConstantMessages::errorResult;
                $message = ConstantMessages::invalidIdMessage;
            }
        }  catch (Exception) {
            $result= ConstantMessages::errorResult;
            $message = ConstantMessages::internalErrorMessage;
        }

        return redirect()->route('employees.index')->with($result, $message);
    }
}
