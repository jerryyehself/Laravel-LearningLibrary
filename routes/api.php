<?php

use App\Http\Controllers\ParserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewParserController;
use App\Http\Controllers\DomainController;
use App\Http\Resources\DomainResource;
use App\Models\Backgroundmodels\Sourcedomain;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('resource.available', 'resource.content')->resource('/user', ParserController::class);



// Route::apiResource('/setting', DomainController::class);
Route::get('/setting/domain/{domain}', [DomainController::class, 'show']);
// Route::resource('/insertdomain', NewParserController::class);
//->middleware('responsetype');