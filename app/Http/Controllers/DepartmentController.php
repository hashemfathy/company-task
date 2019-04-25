<?php

namespace App\Http\Controllers;
use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function getDepartment()
    {
        $departments=Department::all();
        return view('welcome',['departments'=>$departments]);
    }
    public function createDepartment(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:departments'
        ]);
        $department=new Department();
        $department->name = $request['name'];
        $department->save();

        return redirect()->route('get.department');
       
    }
    public function getdeletedepartment($department_id)
    {
        $department = Department::where('id',$department_id)->first();
        $department->delete();
        return redirect()->back();
    }
    public function posteditdepartment(Request $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
        $department = Department::find($request['departmentId']);
        $department->name = $request['name'];
        $department->update();
        return response()->json(['new_name'=>$department->name],200);
    }
    
}
