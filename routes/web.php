<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingCostController;
use App\Livewire\Sale;
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
    return redirect()->route('login');
});

Route::redirect('/dashboard', '/sales');

// Route::get('/sales', function () {
//     return view('coffee_sales');
// })->middleware(['auth'])->name('coffee.sales');
 

Route::get('/shipping-cost', [ShippingCostController::class, 'index'])->name('shipping-cost.index')->middleware(['auth']);
Route::post('/shipping-cost', [ShippingCostController::class, 'update'])->name('shipping-cost.update')->middleware(['auth']);
 

Route::middleware(['auth'])->get('/sales', Sale::class)->name('coffee.sales');


Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
});

require __DIR__.'/auth.php';
