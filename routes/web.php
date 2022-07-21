<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\DealsController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\TaskProjectController;





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



 // start axios login in web route

// Route::get('/Loginasxios', [LoginController::class, 'checkuser']);
// Route::get('/getToken', function(){
//     return csrf_token();
// })->middleware('auth');


 // end axios login in web route

//  Route::get('/indexindex', [LoginController::class, 'index']);


// route of datatable of customers 

// Route::POST('/insert', [DataTableController::class, 'insert']);

// Route::get('/url', [DataTableController::class, 'createComponent']);

// Route::post('/api/insert', 'API\DataTableController@insert');
// Route::post('/api/insert', [DataTableController::class, 'insert']);

// Route::resource('insertt', 'DataTableController');

//insert, edit, delete and fetch from database in DataTableController
Route::get('/getDataTable', [DataTableController::class, 'getDataTableFn']);
Route::get('/getDataTable/{id}', [DataTableController::class, 'editCst']);
Route::get('/deleteData/{id}', [DataTableController::class, 'deleteData']);
Route::get('listCst', [DataTableController::class, 'listCst']);

//insert and fetch from database in Dealscontroller
Route::get('/saveDeal', [DealsController::class, 'saveDeal']);
Route::get('/fetchDealsContact', [DealsController::class, 'fetchDealsContact']);

//insert and fetch from database in TaskProjectController
Route::get('/saveTask', [TaskProjectController::class, 'saveTask']);
Route::get('/fetchUsersTask', [TaskProjectController::class, 'fetchUsersTask']);


//insert, edit, delete and fetch from database in DashBoardController
Route::get('cstDeal', [DashBoardController::class, 'cstDeal']);
Route::get('cstDealDash', [DashBoardController::class, 'cstDealDash']);

//insert, fetch from database
Route::post('auth/login', [LoginController::class, 'Login']);
Route::post('register', [LoginController::class, 'register']);

// Route::Post('login', [LoginController::class, 'Login']);
Route::get('insertusers', [LoginController::class, 'insertusers']);
Route::delete('logout', [LoginController::class, 'logout']);


Route::get('/vue/{vue?}', function () {
    return view('vue');
})->where('vue', '^(?!.*api).*$[\/\w\.-]*');






Route::get('editCst/{id}', [DataTableController::class, 'editCst'])->name('editCst.get');

Route::get('/{any}', [ApplicationController::class, 'index'])->where('any', '.*');

