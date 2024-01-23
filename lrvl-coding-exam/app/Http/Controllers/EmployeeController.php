<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Store;
use Illuminate\Validation\Rule;


use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    public function index(){
        $employees = Employee::with('store')->get();
        return view('employee', compact('employees'));
    }

    public function create(){
        $stores = Store::all();

        return view('forms.create_employee', compact('stores'));
    }

    public function store(Request $request){
        $validStoreIds = Store::pluck('id')->all();

        $request->validate([
            'first_name' => 'required|regex:/^[A-Za-z\s\'-]+$/|max:255',
            'middle_name' => 'nullable|regex:/^[A-Za-z\s\'-]+$/|max:255',
            'last_name' => 'required|regex:/^[A-Za-z\s\'-]+$/|max:255',
            'suffix' => 'nullable|regex:/^(?i)([JSRIVXLCDM.]+)$/|max:5',
            'position' => 'required|regex:/^[A-Za-z][A-Za-z\'\s.,&\/-]*[A-Za-z]$/|max:255',
            'emp_phone_number' => 'required|regex:/^09\d{9}$/|min:11|max:11|unique:employees',
            'emp_email' => 'required|email|min:3|max:320|unique:employees',
            'employee_store' => [
                'required',
                Rule::in($validStoreIds),
            ],
        ], [
          'emp_phone_number.unique' => 'The phone number is already taken by other registered records in the system.',
          'emp_email.unique' => 'The email is already taken by other registered records in the system.',
        ]);

          $data = [
            'indicator' => '0',
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'suffix' => $request->suffix,
          ];

          $employeeExists = Employee::checkEmployeeExists($data);

          if($employeeExists){
            return redirect(route('employee.create'))->with('warning', 'Employee full name already exists.');
          }

          Employee::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'suffix' => $request->suffix,
            'position' => $request->position,
            'emp_phone_number' => $request->emp_phone_number,
            'emp_email' => $request->emp_email,
            'emp_store_id' => $request->employee_store
          ]);

          return redirect(route('employee.index'))->with('message', 'New employee inserted succesfully!');
        
    }

    public function edit($id){
        $employee = Employee::with('store')->find($id);
        $stores = Store::all();
        if($employee){
            return view('forms.edit_employee', compact('employee', 'stores'));
        }else{
            return redirect(route('employee.index'))->with('warning', 'It looks like you are trying to access a record that does not exist.');
        }
    }

    public function update(Request $request, $id){
        $employee = Employee::find($id);
        $validStoreIds = Store::pluck('id')->all();

      $request->validate([
        'first_name' => [
            'required',
            'regex:/^[A-Za-z\s\'-]+$/',
            'max:255',
        ],
        'middle_name' => [
            'nullable',
            'regex:/^[A-Za-z\s\'-]+$/',
            'max:255',
        ],
        'last_name' => [
            'required',
            'regex:/^[A-Za-z\s\'-]+$/',
            'max:255',
        ],
        'suffix' => [
            'nullable',
            'regex:/^(?i)([JSRIVXLCDM.]+)$/',
            'max:5',
        ],
        'position' => [
            'required',
            'regex:/^[A-Za-z][A-Za-z\'\s.,&\/-]*[A-Za-z]$/',
            'max:255',
        ],
        'emp_phone_number' => [
          'required',
          'regex:/^09\d{9}$/',
          'min:11',
          'max:11',
          Rule::unique('employees', 'emp_phone_number')->ignore($id, 'emp_id'),
      ],
      'emp_email' => [
          'required',
          'email',
          'min:3',
          'max:320',
          Rule::unique('employees', 'emp_email')->ignore($id, 'emp_id'),
      ],
        'employee_store' => [
            'required',
            Rule::in($validStoreIds),
        ],
    ], [
        'emp_phone_number.unique' => 'The phone number is already taken by other registered records in the system.',
        'emp_email.unique' => 'The email is already taken by other registered records in the system.',
    ]);

          $data = [
            'indicator' => '1',
            'emp_id' => $id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'suffix' => $request->suffix,
          ];

          $employeeExists = Employee::checkEmployeeExists($data);

          if($employeeExists){
            return redirect(route('employee.edit', $id))->with('warning', 'Employee full name already exists.');
          }

          $employee->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'suffix' => $request->suffix,
            'position' => $request->position,
            'emp_phone_number' => $request->emp_phone_number,
            'emp_email' => $request->emp_email,
            'emp_store_id' => $request->employee_store
          ]);

          return redirect(route('employee.index'))->with('message', 'Employee record updated succesfully!');
    }

    public function delete($id){
        $employee = Employee::find($id);
        if($employee){
            $employee->delete(); 
            return redirect(route('employee.index'))->with('message', 'Employee record deleted succesfully!');
        }else{
            return redirect(route('employee.index'))->with('warning', 'It looks like you are trying to access a record that does not exist.');
        }

    }
}
