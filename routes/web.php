<?php

use App\Http\Controllers\Admin\PlanController;
use Illuminate\Support\Facades\Route;



Route::any('/admin/plans/search', [PlanController::class, 'search'])->name('plans.search');//new sintax
//Route::get('admin/plans','Admin/PlanController@index')->name('plans.index');//old sintax
Route::get('/admin/plans/create', [PlanController::class, 'create'])->name('plans.create');//new sintax
Route::post('/admin/plans', [PlanController::class, 'store'])->name('plans.store');//new sintax

Route::get('/admin/plans', [PlanController::class, 'index'])->name('plans.index');//new sintax
Route::get('/admin', [PlanController::class, 'index'])->name('admin.index');//new sintax
Route::get('/admin/plans/{url}', [PlanController::class, 'show'])->name('plans.show');//new sintax
Route::get('/admin/plans/{url}/edit', [PlanController::class, 'edit'])->name('plans.edit');//new sintax
Route::delete('/admin/plans/{id}', [PlanController::class, 'destroy'])->name('plans.destroy');//new sintax

Route::get('/', function () {
    return view('welcome');
});
