<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

//item
Route::prefix('/item')->group(function () {
    Route::get('/',[ItemController::class,'index'])->name('all.item');
    Route::get('add',[ItemController::class,'create'])->name('create.item');
    Route::post('add',[ItemController::class,'store'])->name('store.item');
    Route::get('update/{id}',[ItemController::class,'edit'])->name('edit.item');
    Route::put('update/{id}',[ItemController::class,'update'])->name('update.item');
    Route::get('delete/{id}',[ItemController::class,'destroy'])->name('destroy.item');
});

//product
Route::prefix('/product')->group(function () {
    Route::get('/',[ProductController::class,'index'])->name('all.product');
    Route::get('add',[ProductController::class,'create'])->name('create.product');
    Route::post('add',[ProductController::class,'store'])->name('store.product');
    Route::get('update/{id}',[ProductController::class,'edit'])->name('edit.product');
    Route::put('update/{id}',[ProductController::class,'update'])->name('update.product');
    Route::get('delete/{id}',[ProductController::class,'destroy'])->name('destroy.product');
});

Route::prefix('/order')->group(function () {
    Route::get('/',[OrderController::class,'index'])->name('all.order');
    Route::get('add',[OrderController::class,'create'])->name('create.order');
    Route::post('add',[OrderController::class,'store'])->name('store.order');
    Route::get('update/{id}',[OrderController::class,'edit'])->name('edit.order');
    Route::put('update/{id}',[OrderController::class,'update'])->name('update.order');
    Route::get('delete/{id}',[OrderController::class,'destroy'])->name('destroy.order');
});

// Route::get('/add-product', [ProductController::class,'formData'])->middleware(['auth'])->name('add.product');

// Route::post('/insert-product',[ProductController::class,'store'])->middleware(['auth']);

// Route::post('/insert-new-product',[ProductController::class,'createItem'])->middleware(['auth']);

// Route::get('/all-product',[ProductController::class,'allProduct'])->middleware(['auth'])->name('all.product');

// Route::get('/available-products',[ProductController::class,'availableProducts'])->middleware(['auth'])->name('available.products');

// Route::get('/purchase-products/{id}', [ProductController::class,'purchaseData'])->middleware(['auth']);

// Route::post('/insert-purchase-products',[ProductController::class,'storePurchase'])->middleware(['auth']);

// Route::get('/edit-product/{id}',[ProductController::class,'editData'])->middleware(['auth']);

// Route::put('all_product/update/{id}', [ProductController::class,'update'])->name('all_product.update');

// Route::get('all_product/delete/{id}', [ProductController::class,'delete'])->name('all_product.delete');

// Route::get('all-item',[ProductController::class,'allitem'])->middleware(['auth'])->name('all.item');

// Route::get('all-master',[ProductController::class,'allmaster'])->middleware(['auth'])->name('all.master');



//invoice
Route::get('/add-invoice/{id}', [InvoiceController::class,'formData'])->middleware(['auth']);

Route::get('/new-invoice', [InvoiceController::class,'newformData'])->middleware(['auth'])->name('new.invoice');

Route::post('/insert-invoice',[InvoiceController::class,'store'])->middleware(['auth']);

Route::get('/invoice-details', function () {
    return view('Admin.invoice_details');
})->middleware(['auth'])->name('invoice.details');

Route::get('/all-invoice', [InvoiceController::class,'allInvoices'])->middleware(['auth'])->name('all.invoices');

Route::get('/sold-products',[InvoiceController::class,'soldProducts'])->middleware(['auth'])->name('sold.products');
// Route::get('/delete', [InvoiceController::class,'delete']);


//order
// Route::get('/add-order/{name}', [OrderController::class,'newFormData'])->middleware(['auth'])->name('add.order');

// Route::post('/insert-order',[OrderController::class,'store'])->middleware(['auth']);

// Route::get('/all-orders',[OrderController::class,'ordersData'])->middleware(['auth'])->name('all.orders');

// Route::get('/pending-orders',[OrderController::class,'pendingOrders'])->middleware(['auth'])->name('pending.orders');

// Route::get('/delivered-orders',[OrderController::class,'deliveredOrders'])->middleware(['auth'])->name('delivered.orders');

// Route::get('/new-order', [OrderController::class,'newformData'])->middleware(['auth'])->name('new.order');

// Route::post('/insert-new-order',[OrderController::class,'newStore'])->middleware(['auth']);


//customer
Route::get('/add-customer', function () {
    return view('Admin.add_customer');
})->middleware(['auth'])->name('add.customer');

Route::post('/insert-customer',[CustomerController::class,'store'])->middleware(['auth']);

Route::get('/all-customers',[CustomerController::class,'customersData'])->middleware(['auth'])->name('all.customers');

Route::get('/edit-customer/{id}',[CustomerController::class,'edit'])->middleware(['auth']);

Route::put('all_customers/update/{id}', [CustomerController::class,'update'])->name('all_customers.update');

Route::get('all_customers/delete/{id}', [CustomerController::class,'delete'])->name('all_customers.delete');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
