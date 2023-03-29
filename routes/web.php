<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssessmentTestController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/',[AssessmentTestController::class,'index']);
Route::post('save_data',[AssessmentTestController::class,'save_data']);
Route::get('edit/{id}',[ AssessmentTestController ::class,'edit']);
Route::get('delete_data/{id}',[ AssessmentTestController ::class,'delete_data']);
Route::post('edit_data',[ AssessmentTestController ::class,'edit_data']);
