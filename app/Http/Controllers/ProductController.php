<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\grn;
use App\Models\grn_item;
use App\Models\invoice;
use App\Models\invoice_item;
use App\Models\product;
use App\Models\stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //add Product

    public function addProduct(Request $request)
    {
        $validetor = Validator::make($request->all(), [
            'product_id' => 'required',
            'product_name' => 'required',
            'brand_id' => 'required'
        ]);

        if ($validetor->fails()) {
            return response()->json(['err' => $validetor->errors()], 422);
        }

        $product = product::where('product_name', $request->input('product_name'))->exists();

        if ($product) {
            return response()->json(['err' => 'Product alredy registered'], 422);
        }

        $productData = product::create([
            'id' => $request->input('product_id'),
            'brand_id' => $request->input('brand_id'),
            'product_name' => $request->input('product_name'),
        ]);

        return response()->json(['addNew' => $productData], 200);
    }

    //all Product

    public function allProduct(Request $request){
        $productData = DB::table('products')->join('brands','products.brand_id','=','brands.id')->get();

        return response()->json(['products'=> $productData],200);
    }


    //add brand

    public function addBrand(Request $request){

        $validetor = Validator::make($request->all(),[

            'brand_name'=>'required',

        ]);

        if ($validetor->fails()) {
            return response()->json(['err' => $validetor->errors()], 422);
        }

        $brand = brand::where('brand_name',$request->input('brand_name'))->exists();

        if($brand){
            return response()->json(['err' => 'Brand alredy registered'], 422);
        }

        $neWbrandData = brand::create([
            'brand_name'=>$request->input('brand_name'),
        ]);

        return response()->json(['newBrand'=>$neWbrandData],200);
    }


    //all brands

    public function allBrand(Request $request){
        $allBrands = brand::all();

        return response()->json(['brands'=> $allBrands],200);
    }


    //all stocks

    public function allStock(Request $request){
        $stock_data = DB::table('stocks')->join('products','stocks.product_id','=','products.id')->join('brands','products.brand_id','=','brands.id')->get();
        return response()->json(['stockData'=> $stock_data],200);
    }




    //save grn Items
    public function saveGrnItems(Request $request,$grnNumber, $employeeEmail, $supplierMobile, $paidAmount){

        $grn = grn::create([
            'id'=>$grnNumber,
            'supplier_mobile'=>$supplierMobile,
            'employee_email'=>$employeeEmail,
            'paid_amount'=>$paidAmount
        ]);

        $allGrnItems = $request->json()->all();

        foreach ($allGrnItems as $grnItem){
            
          $productId = $grnItem['productId'];
          $sellingPrice = $grnItem['selling_Price'];
          $buyingPrice = $grnItem['buying_price'];
          $qty = $grnItem['qty'];
          $mfd = $grnItem['mfd'];
          $exp = $grnItem['exp'];

          $stock_id = 0;

          $stock_find = stock::where('product_id',$productId)->where('selling_price',$sellingPrice)->where('qty',$qty)->where('mfd',$mfd)->where('exp',$exp)->exists();

          if($stock_find){

            $productStock = stock::where('product_id',$productId)->first();
            $currentQty = $productStock->qty;
            $newQty = $currentQty + $qty;

            $stock = stock::where('product_id',$productId)->first();
            $stock->update([
                'qty'=> $newQty,
            ]);

           $stock_id = $productStock->id;

          }else{

            $stock = stock::create([

                'product_id' => $productId,
                'selling_price' => $sellingPrice,
                'qty' => $qty,
                'mfd' => $mfd,
                'exp' => $exp,

            ]);

            $productStock = stock::where('product_id',$productId)->first();
            $stock_id = $productStock->id;

          }


          $grnItemsData = grn_item::create([
            'stock_id' => $stock_id,
            'qty' => $qty,
            'buying_price' => $buyingPrice,
            'grn_id' => $grnNumber,

          ]);

        }

        return response()->json(['msg'=>'sucess'],200);
    }

    //save invoice
    public function saveInvoice(Request $request,$invoiceNumber,$employeeEmail,$customerMobile,$paidAmount,$discount,$mid){
        $invoice = invoice::create([
            'id'=>$invoiceNumber,
            'customer_mobile'=>$customerMobile,
            'employee_email'=>$employeeEmail,
            'paid_amount'=>$paidAmount,
            'discount'=>$discount,
            'payment_method_id'=>$mid,
        ]);

        $allInvoiceItems = $request->json()->all();

        foreach($allInvoiceItems as $incoiceItem){
            $stockId = $incoiceItem['id'];
            $qty = $incoiceItem['qty'];

            $stockTable = stock::where('id',$stockId)->first();
            $currentQtyStock = $stockTable->qty;
            $updateQty = $currentQtyStock - $qty;
            $stockTable->update([
                'qty'=>$updateQty,
            ]);

            invoice_item::create([
                'stock_stock_id'=>$stockId,
                'qty'=>$qty,
                'invoice_id'=>$invoiceNumber,
            ]);
        }

        return response()->json(['msg'=>'sucess'],200);
    }
}
