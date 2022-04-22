<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\FormContentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParserController;

use App\Http\Controllers\SourceDomainController;
use App\Http\Controllers\WorksController;
use App\Http\Controllers\LanguagesController;
use App\Http\Controllers\PackagetoolsController;
use App\Http\Controllers\FrameworksController;
use App\Http\Controllers\EnvironmentsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'home');

Route::get('/insertdomain/{all_domain}', [DomainController::class, 'store']);

Route::middleware('resource.available', 'resource.content')
    ->post('/', [ParserController::class, 'index']);
// Route::post('/', [ParserController::class, 'index']);


Route::prefix('setting')->group(function () {
    Route::resources([
        '' => SourceDomainController::class,
        'sourcesites' => SourceDomainController::class,
        'works' => WorksController::class,
        'languages' => LanguagesController::class,
        'packagetools' => PackagetoolsController::class,
        'environments' => EnvironmentsController::class,
        'frameworks' => FrameworksController::class,
        'documents' => DocumentController::class
    ]);
});

// Route::post('/setting/domain', [DomainController::class, 'store']);
// Route::prefix('collection')->group(function () {
//     Route::resources([
//         'sourcesites' => SourceDomainController::class,
//         'works' => WorksController::class,
//         'languages' => LanguagesController::class,
//         'packagetools' => PackagetoolsController::class,
//         'environments' => EnvironmentsController::class,
//         'frameworks' => FrameworksController::class,
//         'documents' => DocumentController::class
//     ]);
//     // Route::get('/', [FormContentController::class, 'contentList']);
// });
