<?php

use App\Modules\Auth\Admin\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Hash;
use \Carbon\Carbon;

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

Route::post('admins', [\App\Modules\Auth\Admin\Controllers\AdminDashboardController::class, 'store']);

Route::post('dashboard/login', function (Request $request) {
    $admin = Admin::Where('email', $request->email)->first();
    if ($admin && Hash::check($request->password, $admin->password)) {
        $objToken = $admin->createToken('admin');
        $admin['abilities'] = [
            [
                'subject' => 'all',
                'action' => 'manage'
            ]
        ];
        $strToken = $objToken->plainTextToken;
        return response()->json(
            [
                'message' => "Welcome $admin->name",
                'data' =>
                    [
                        "token_type" => "Bearer",
                        "token" => $strToken,
                        'user' => $admin
                    ]
            ], 200);
    } else {
        return response()->json(['error' => 'Unauthorized', 'message' => 'Unauthorized', 'data' => null], 401);
    }
});

Route::middleware('auth:sanctum')->post('login-token', function (Request $request) {
    $admin = $request->user();
    $admin = Admin::find($admin->id);
    if ($admin) {

        $objToken = $admin->createToken('MyApp', ['admin']);

        $admin['abilities'] = [
            [
                'subject' => 'all',
                'action' => 'manage'
            ]
        ];
        $strToken = $objToken->plainTextToken;
        return response()->json(
            [
                'message' => "Welcome back $admin->name",
                'data' =>
                    [
                        "token_type" => "Bearer",
                        "token" => $strToken,
                        'user' => $admin
                    ]
            ], 200);
    } else {
        return response()->json(['error' => 'Unauthorized', 'message' => 'Unauthorized', 'data' => null], 401);
    }
});
