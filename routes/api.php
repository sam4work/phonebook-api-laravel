<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PhoneNumberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
	return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {

	Route::apiResource('contacts', ContactController::class);
	Route::apiResource('phone-numbers', PhoneNumberController::class);

	Route::get("/images/{filename}", function ($filename) {
		return Storage::get("images/$filename");
	});
});
