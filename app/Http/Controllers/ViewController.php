<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    //all Invoice
    public function allInvoice(Request $request,$mobile,$invoiceNumber)
    {
 
        if($invoiceNumber == 0 && $mobile == "07"){
            $invoice_data = DB::table('invoices')->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')->join('stocks', 'invoice_items.stock_stock_id', '=', 'stocks.id')
            ->join('products', 'stocks.product_id', '=', 'products.id')->join('brands', 'products.brand_id', '=', 'brands.id')->join('payment_methods', 'invoices.payment_method_id', '=', 'payment_methods.id')->where('customer_mobile','LIKE',''.$mobile.'%')->get();

        }else if($invoiceNumber != 0 & $mobile == "07") {
            $invoice_data = DB::table('invoices')->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')->join('stocks', 'invoice_items.stock_stock_id', '=', 'stocks.id')
            ->join('products', 'stocks.product_id', '=', 'products.id')->join('brands', 'products.brand_id', '=', 'brands.id')->join('payment_methods', 'invoices.payment_method_id', '=', 'payment_methods.id')->where('customer_mobile','LIKE',''.$mobile.'%')->where('invoice_id','LIKE',''.$invoiceNumber.'')->get();

        }else{
            $invoice_data = invoice::all();
        }
 
        return response()->json(['invoiceData' => $invoice_data], 200);
    }


    //all grns
    public function allGrn(Request $request,$mobile,$grnNumber){

        if($grnNumber == 0 && $mobile == "07"){
            $grn_data = DB::table('grns')->join('grn_items','grns.id','=','grn_items.grn_id')->join('stocks','grn_items.stock_id','=','stocks.id')->where('supplier_mobile','LIKE',''.$mobile.'%')->get();
        }else if($grnNumber != 0 && $mobile == "07"){
            $grn_data = DB::table('grns')->join('grn_items','grns.id','=','grn_items.grn_id')->join('stocks','grn_items.stock_id','=','stocks.id')->where('supplier_mobile','LIKE',''.$mobile.'%')->where('grn_id','LIKE',''.$grnNumber.'')->get();
        }
        

        return response()->json(['grnData'=>$grn_data],200);
    }

    //total revenue
    public function totalRevenue(Request $req){
        $allInvoice = invoice::all();
        
        $total = 0;

        foreach($allInvoice as $invoice){
            $total = $total  + $invoice->paid_amount;
        }

        return response()->json(['totalRevenue'=>$total],200);
    }
}
