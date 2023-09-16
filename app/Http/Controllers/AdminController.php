<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\employee_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    //login
    public function logIn(Request $request){

        $validetor = Validator::make($request->all(),[
            'email'=>'required',
            'password'=>'required',
        ]);

        if($validetor->fails()){
            return response()->json(['edata'=>"error"],422);
        }

        $auth = employee::where('email',$request->input('email'))->where('password',$request->input('password'))->exists();
        if(!$auth){
            return response()->json(['edata'=>'error'],422);
        }

        $employee = employee::where('email',$request->input('email'))->get();

        return response()->json(['edata'=>$employee],200);

    }

    // add employee
    public function addEmployee(Request $request)
    {

        $validetor =    Validator::make($request->all(), [
            'email' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'nic' => 'required',
            'mobile' => 'required',
            'password' => 'required',
            'gender_id' => 'required',
            'employee_id' => 'required',
        ]);

        if ($validetor->fails()) {
            return response()->json(['err' => $validetor->errors()], 422);
        }


        $findEmployee = employee::where('mobile', $request->input('mobile'))->orWhere('nic', $request->input('nic'))->exists();

        if ($findEmployee) {
            return response()->json(['err' => 'mobile or nic alredy used'], 422);
        }

        $employeeData = employee::create([
            'email' => $request->input('email'),
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'nic' => $request->input('nic'),
            'mobile' => $request->input('mobile'),
            'password' => $request->input('password'),
            'gender_id' => $request->input('gender_id'),
            'employee_id' => $request->input('employee_id')
        ]);
        return response()->json(['neEmployee' => $employeeData], 200);
    }
    // update employee
    public function employeeUpdate(Request $request, $email)
    {

        //find update employee
        $employee = employee::where('email', $email)->first();

        $employee->update($request->all());

        // $employee->fname = $request->input('fname',$employee->fname);
        // $employee->lname = $request->input('lname',$employee->lname);
        // $employee->nic = $request->input('nic',$employee->nic);
        // $employee->mobile = $request->input('mobile',$employee->mobile);

        // $employee->save();

        return response()->json(['employee' => $employee], 200);
    }
    // all employees

    public function allEmployee(Request $request, $mobile)
    {




        $allEmployeeData = employee::where('mobile', 'LIKE', '' . $mobile . '%')->get();


        // $allEmployeeData = employee::all();
        // $employeesData = [];
        // foreach ($allEmployeeData as $employeeOne) {
        //     $employeeData = $employeeOne->toArray();
        //     $employeeData['email'] = $employeeOne->email;
        //     $employeesData[] = $employeeData;
        // }



        return response()->json(['allEmployee' => $allEmployeeData], 200);
    }

    //all employee Types

    public function employeeTypes(Request $request)
    {
        $types = employee_type::all();
        return response()->json(['types' => $types], 200);
    }
}
