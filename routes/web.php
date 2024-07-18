<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/', [UserController::class, 'ShowIndexPage'])->name('ShowIndexPage');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //商品
    Route::get("/dashboard/post",[AdminController::class,"ShowPostPage"])->name("ShowPostPage");
    Route::post("/dashboard/post",[AdminController::class,"AddPost"])->name("AddPost");
    Route::post('/dashboard/product/{product}', [AdminController::class,"UpdateProduct"])->name('UpdateProduct');
    Route::delete("/dashboard/product",[AdminController::class,"DeleteProduct"])->name("DeleteProduct");
    Route::post("/dashboard/toggle-product",[AdminController::class,"ToggleProduct"])->name("ToggleProduct");
});

require __DIR__.'/auth.php';
