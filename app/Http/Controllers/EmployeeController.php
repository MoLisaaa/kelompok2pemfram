<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Position;



class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Employee Detail';

         // ELOQUENT
        $employee = Employee::find($id);


        return view('employee.show', compact('pageTitle', 'employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Edit Employee';

         // ELOQUENT
         $positions = Position::all();
         $employee = Employee::find($id);

        return view('employee.edit', compact('pageTitle', 'employee', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
                // validasi input
                $messages = [
                    'required' => ':attribute harus diisi.',
                    'email' => 'Isi :attribute dengan format yang benar.',
                    'numeric' => 'Isi :attribute dengan angka.'
                ];

                // Validasi menggunakan Validator
                $validator = Validator::make($request->all(), [
                    'firstName' => 'required',
                    'lastName' => 'required',
                    'email' => 'required|email',
                    'age' => 'required|numeric',
                ], $messages);

                // kembali ke halaman sebelumnya with error
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                 // ELOQUENT
                $employee = Employee::find($id);
                $employee->firstname = $request->firstName;
                $employee->lastname = $request->lastName;
                $employee->email = $request->email;
                $employee->age = $request->age;
                $employee->position_id = $request->position;
                $employee->save();

                return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
