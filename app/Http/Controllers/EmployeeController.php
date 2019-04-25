<?php

namespace App\Http\Controllers;
use App\Employee;
use App\Department;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function getEmployees(Department $department)
    {
        $employees = $department->employees()->paginate(10);
        
        return view('employee',['employees'=>$employees,'department'=>$department]);
    }
    public function createEmployee(Request $request ,Department $department)
    {
        $this->validate($request,[
            'name' => 'required',
            'mobile_number'=>'required|unique:employees',
            'email'=>'email|required|unique:employees',

        ]);
        $employee=new Employee();
        $employee->name = $request['name'];
        $employee->mobile_number = $request['mobile_number'];
        $employee->email = $request['email'];
        $employee->Department_id =$department->id ;
        $employee->save();

        return redirect()->route('get.employees',[$department->id]);
       
    }
    public function getdeleteemployee($employee_id)
    {
        $employee = Employee::where('id',$employee_id)->first();
        $employee->delete();
        return redirect()->back();
    }
    public function posteditEmployee(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'mobile_number'=>'required|unique:employees,mobile_number,'.$request->employee_id,
            'email'=>'email|required|unique:employees,email,'.$request->employee_id,
        ]);
        $employee = Employee::find($request->employee_id);
        $employee->name = $request['name'];
        $employee->mobile_number = $request['mobile_number'];
        $employee->email = $request['email'];
        $employee->update();
        
    }
}
