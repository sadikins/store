<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apps\RoleController;
use App\Http\Controllers\Apps\UserController;
use App\Http\Controllers\Apps\ReportController;
use App\Http\Controllers\Apps\ProductController;
use App\Http\Controllers\Apps\CategoryController;
use App\Http\Controllers\Apps\CustomerController;
use App\Http\Controllers\Apps\DashboardController;
use App\Http\Controllers\Apps\PermissionController;
use App\Http\Controllers\Apps\TransactionController;

//route home
Route::get('/', function () {
    return \Inertia\Inertia::render('Auth/Login');
})->middleware('guest');


//prefix "apps"
Route::prefix('apps')->group(function() {

    //middleware "auth"
    Route::group(['middleware' => ['auth']], function () {

        //route dashboard
        Route::get('dashboard', DashboardController::class)->name('apps.dashboard')->middleware('permission:dashboard.index');
        
        //route permissions
        Route::get('/permissions', PermissionController::class)->name('apps.permissions.index')
            ->middleware('permission:permissions.index');

        //route resource roles
        Route::resource('/roles', RoleController::class, ['as' => 'apps'])
            ->middleware('permission:roles.index|roles.create|roles.edit|roles.delete');

        //route resource users
        Route::resource('/users', UserController::class, ['as' => 'apps'])
            ->middleware('permission:users.index|users.create|users.edit|users.delete');

        //route resource categories
        Route::resource('/categories', CategoryController::class, ['as' => 'apps'])
            ->middleware('permission:categories.index|categories.create|categories.edit|categories.delete');    
    
        //route resource products
        Route::resource('/products', ProductController::class, ['as' => 'apps'])
        ->middleware('permission:products.index|products.create|products.edit|products.delete');

        //route resource customers
        Route::resource('/customers', CustomerController::class, ['as' => 'apps'])
            ->middleware('permission:customers.index|customers.create|customers.edit|customers.delete');

        //route transaction
        Route::get('/transactions', [TransactionController::class, 'index'])->name('apps.transactions.index');

        //route transaction searchProduct
        Route::post('/transactions/searchProduct', [TransactionController::class, 'searchProduct'])->name('apps.transactions.searchProduct');
        
        //route transaction addToCart
        Route::post('/transactions/addToCart', [TransactionController::class, 'addToCart'])->name('apps.transactions.addToCart');

        //route transaction destroyCart
        Route::post('/transactions/destroyCart', [TransactionController::class, 'destroyCart'])->name('apps.transactions.destroyCart');

        //route transaction store
        Route::post('/transactions/store', [TransactionController::class, 'store'])->name('apps.transactions.store');

        //route transaction print
        Route::get('/transactions/print', [TransactionController::class, 'print'])->name('apps.transactions.print');

        //route sales index
        Route::get('/reports/sales', [ReportController::class, 'index'])->middleware('permission:sales.index')->name('apps.sales.index');
        
        //route sales filter
        Route::get('/reports/sales/filter', [ReportController::class, 'filter'])->name('apps.sales.filter');

        //route profits index
        Route::get('/reports/profits', [ReportController::class, 'profit'])->middleware('permission:profits.index')->name('apps.profits.index');

        //route profits filter
        Route::get('/reports/profits/filter', [ReportController::class, 'profit_filter'])->name('apps.profits.filter');
 

    });
});
