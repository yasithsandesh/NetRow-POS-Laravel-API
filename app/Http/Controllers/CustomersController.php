<?php

namespace App\Http\Controllers;

use App\Models\customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    //add customer
    public function addCustomer(Request $request){
        $validetor = Validator::make($request->all(),[
            'mobile'=>'required',
            'fname'=>'required',
            'lname'=>'required',
            'email'=>'required',
            'points'=>'required',
        ]);

        if($validetor->fails()){
            return response()->json(['err' => $validetor->errors()],422);
        }

        $findCustomers = customers::where('mobile',$request->input('mobile'))->orWhere('email',$request->input('email'))->get();

        if($findCustomers == null){

            return response()->json(['err'=>'customer already registered'],422);

        }else{
            $customerData = customers::create([
                'mobile'=>$request->input('mobile'),
                'fname'=>$request->input('fname'),
                'lname'=>$request->input('lname'),
                'email'=>$request->input('email'),
                'points'=>$request->input('points'),
            ]);
        }

     

        return response()->json(['newCustomer'=>$customerData],200);
    }

    
    //update customer
    public function updateCustomer(Request $request, $mobile){
        
        $customer = customers::where('mobile',$mobile)->first();

        $customer->update($request->all());

        return response()->json(['updateCustomer'=>$customer],200);
    }


    //all customers
    public function allCustomers($mobile){

        $allCustomers = customers::where('mobile','LIKE',''.$mobile.'%')->get();
        return response()->json(['all'=>$allCustomers],200);
        
    }
}
