<?php

use App\Helpers\Files;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('setting/all', function () {
    return response()->json(['message' => '', 'data' => ['app' => ['langs' => ['en']]]], 200);
});

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('file/upload', function (\Illuminate\Http\Request $request) {
        return \App\Helpers\Helper::createSuccessResponse(['file' => Files::defaultUpload($request['file'])], 'File uploaded successfully');
    })->name('file.upload');

//  Admins
    Route::resource('admins', \App\Modules\Auth\Admin\Controllers\AdminDashboardController::class)->except(['store']);

//  Articles
    Route::resource('articles', \App\Modules\Article\Controllers\ArticleDashboardController::class);
    Route::get('get-giphy-api', [\App\Modules\Article\Controllers\ArticleDashboardController::class, 'getGiphyApi']);
});
