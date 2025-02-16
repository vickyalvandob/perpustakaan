<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::controller(CategoryController::class)->group(function () {
        Route::get('categories','index')->name('admin.category.index');
        Route::get('category/create','create')->name('admin.category.create');
        Route::post('category/create','store')->name('admin.category.store');
        Route::get('category/edit/{category}','edit')->name('admin.category.edit');
        Route::put('category/edit/{category}','update')->name('admin.category.update');
        Route::delete('category/destroy/{category}','destroy')->name('admin.category.destroy');
    });
});