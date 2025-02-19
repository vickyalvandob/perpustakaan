<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\BookController;
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

    Route::controller(PublisherController::class)->group(function () {
        Route::get('publishers','index')->name('admin.publisher.index');
        Route::get('publisher/create','create')->name('admin.publisher.create');
        Route::post('publisher/create','store')->name('admin.publisher.store');
        Route::get('publisher/edit/{publisher}','edit')->name('admin.publisher.edit');
        Route::put('publisher/edit/{publisher}','update')->name('admin.publisher.update');
        Route::delete('publisher/destroy/{publisher}','destroy')->name('admin.publisher.destroy');
    });

    Route::controller(BookController::class)->group(function () {
        Route::get('books','index')->name('admin.book.index');
        Route::get('book/create','create')->name('admin.book.create');
        Route::post('book/create','store')->name('admin.book.store');
        Route::get('book/edit/{book}','edit')->name('admin.book.edit');
        Route::put('book/edit/{book}','update')->name('admin.book.update');
        Route::delete('book/destroy/{book}','destroy')->name('admin.book.destroy');
    });

});