<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\ViewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//http://localhost:8000/api/add-employee

Route::post('/add-employee',[AdminController::class, 'addEmployee']);

//http://localhost:8000/api/update-employee
Route::put('/update-employee/{email}',[AdminController::class,'employeeUpdate']);

//http://localhost:8000/api/all-employee/{mobile}
Route::get('/all-employee/{mobile}',[AdminController::class,'allEmployee']);

//http://localhost:8000/api/employee-types
Route::get('/employee-types',[AdminController::class,'employeeTypes']);


//customers
//http://localhost:8000/api/add-customer
Route::post('/add-customer',[CustomersController::class,'addCustomer']);

//http://localhost:8000/api/update-customer/{mobile}
Route::put('/update-customer/{mobile}',[CustomersController::class,'updateCustomer']);

//http://localhost:8000/api/all-customers
Route::get('/all-customers/{mobile}',[CustomersController::class,'allCustomers']);

//suppliers
//http://localhost:8000/api/company-add
Route::post('/company-add',[SuppliersController::class,'addCompany']);

//http://localhost:8000/api/company-update/{id}
Route::put('/company-update/{id}',[SuppliersController::class,'updateCompany']);

//http://localhost:8000/api/all-company
Route::get('/all-company',[SuppliersController::class,'allCompany']);

//http://localhost:8000/api/add-supplier
Route::post('/add-supplier',[SuppliersController::class,'addSuppliers']);

//http://localhost:8000/api/update-supplier/{mobile}
Route::put('/update-supplier/{mobile}',[SuppliersController::class,'updateSupplier']);

//http://localhost:8000/api/all-suppliers
Route::get('/all-suppliers/{mobile}',[SuppliersController::class,'allSuppliers']);



//http://localhost:8000/api/add-product
Route::post('/add-product',[ProductController::class,'addProduct']);
//http://localhost:8000/api/all-product
Route::get('/all-product',[ProductController::class,'allProduct']);

//http://localhost:8000/api/add-brand
Route::post('/add-brand',[ProductController::class,'addBrand']);
//http://localhost:8000/api/all-brand
Route::get('/all-brand',[ProductController::class,'allBrand']);
//http://localhost:8000/api/all-stock
Route::get('/all-stock',[ProductController::class,'allStock']);

//http://localhost:8000/api/save-grn/{grnNumber}/{employeeEmail}/{supplierMobile}/{paidAmount}
Route::put('/save-grn/{grnNumber}/{employeeEmail}/{supplierMobile}/{paidAmount}',[ProductController::class,'saveGrnItems']);

//http://localhost:8000/api/save-invoice/{invoiceNumber}/{employeeEmail}/{customerMobile}/{paidAmount}/{discount}/{mid}
Route::put('/save-invoice/{invoiceNumber}/{employeeEmail}/{customerMobile}/{paidAmount}/{discount}/{mid}',[ProductController::class,'saveInvoice']);


//all Invoice

//http://localhost:8000/api/all-invoice/{mobile}/{invoiceNumber}
Route::get('/all-invoice/{mobile}/{invoiceNumber}',[ViewController::class,'allInvoice']);

// auth
//http://localhost:8000/api/auth
Route::post('/auth',[AdminController::class,'logIn']);

//http://localhost:8000/api/all-grn
Route::get('/all-grn/{mobile}/{grnNumber}',[ViewController::class,'allGrn']);

//http://localhost:8000/api/total-revenue
Route::get('/total-revenue',[ViewController::class,'totalRevenue']);