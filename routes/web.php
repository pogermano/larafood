<?php

use App\Http\Controllers\Admin\PlanController;
use Illuminate\Support\Facades\Route;

//Route::get('admin/plans','Admin/PlanController@index')->name('plans.index');//old sintax
Route::get('/admin/plans', [PlanController::class, 'index'])->name('plans.index');//new sintax

Route::get('/', function () {
    return view('welcome');
});
