<?php

namespace App\Http\Controllers;

use App\Models\company;
use App\Models\supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SuppliersController extends Controller
{
    //add company
    public function addCompany(Request $request){
        $validetor = Validator::make($request->all(),[
            'name'=>'required',
            'hotline'=>'required',
        ]);

        if($validetor->fails()){
            return response()->json(['err'=> $validetor->errors()],422);
        }

        $findCompany = company::where('c_name',$request->input('name'))->orWhere('hotline',$request->input('hotline'))->exists();

        if($findCompany){
            return response()->json(['err'=>'company or hotline alredy registered'],400);
        }

        $company_data = company::create([
            'c_name'=>$request->input('name'),
            'hotline'=>$request->input('hotline'),
        ]);

        return response()->json(['newCompany'=>$company_data],200);
    }

    //update company
    public function updateCompany(Request $request,$id){
        $company = company::where('id',$id)->first();
        $company->update($request->all());

        return response()->json(['message'=>'Sucess'],200);
    }

    //all company
    public function allCompany(){
        $allCompany = company::all();
        return response()->json(['allCompany'=>$allCompany],200);
    }

    //add suppliers
    public function addSuppliers(Request $request){
        $validetor = Validator::make($request->all(),[
            'mobile'=>'required',
            'fname'=>'required',
            'lname'=>'required',
            'email'=>'required',
            'company_id'=>'required',
        ]);

        if($validetor->fails()){
            return response()->json(['err'=> $validetor->errors()],200);
        }

        $findSupplier = supplier::where('mobile',$request->input('mobile'))->orWhere('email',$request->input('email'))->exists();

        if($findSupplier){
            return response()->json(['err'=>'mobile or email alredy used'],200);
        }

        $newSuppliers = supplier::create([
            'mobile'=>$request->input('mobile'),
            'fname'=>$request->input('fname'),
            'lname'=>$request->input('lname'),
            'email'=>$request->input('email'),
            'company_id'=>$request->input('company_id')
        ]);

        return response()->json(['newSuppliers'=> $newSuppliers],200);

    }

    //update suppliers
    public function updateSupplier(Request $request,$mobile){

        $findSupplier = supplier::where('mobile',$mobile)->first();

        $findSupplier->update($request->all());

        return response()->json(['message'=>'sucess'],200);
    }

    //all suppliers
    public function allSuppliers($mobile){
        $allSuppliers = DB::table('suppliers')->join('companies','suppliers.company_id','=','companies.id')->where('mobile','LIKE',''.$mobile.'%')->get();
        return response()->json(['all'=>$allSuppliers],200);
    }
}
