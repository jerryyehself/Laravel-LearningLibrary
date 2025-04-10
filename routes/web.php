<?php

use App\Http\Controllers\CollectionPageController;
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
use App\Http\Controllers\GitInfoController;
use App\Http\Controllers\SettingPageController;
use App\Http\Controllers\StaticPageController;

    /*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/;
Route::get('/insertdomain/{all_domain}', [DomainController::class, 'store']);

Route::prefix('/')->group(function () {
    // Route::middleware('resource.available', 'resource.content')
    //     ->post('/resource/search', [ParserController::class, 'search']);
    // Route::post('/resource/create', [ParserController::class, 'store']);
    Route::get('', function () {
        return view('home');
    })->name('home');
});
// Route::post('/', [ParserController::class, 'index']);

Route::prefix('collections')->group(function () {
    Route::get('/', [CollectionPageController::class, 'menu'])->name('collections');
    Route::get('/works', [CollectionPageController::class, 'work']);
    Route::get('/languages', [CollectionPageController::class, 'language']);
    Route::get('/packagetools', [CollectionPageController::class, 'packagetool']);
    Route::get('/environments', [CollectionPageController::class, 'environment']);
    Route::get('/frameworks', [CollectionPageController::class, 'framework']);
    Route::get('/documents', [CollectionPageController::class, 'document']);
});

Route::prefix('statics')->group(function () {
    Route::get('/', [StaticPageController::class, 'index'])->name('statics');
});

Route::redirect('/setting', '/setting/works');

Route::prefix('setting')->group(function () {
    Route::resources([
        '/sourcesites' => SourceDomainController::class,
        '/works' => WorksController::class,
        '/practiceType_languages' => LanguagesController::class,
        '/practiceType_packagetools' => PackagetoolsController::class,
        '/practiceType_environments' => EnvironmentsController::class,
        '/practiceType_frameworks' => FrameworksController::class,
        '/documents' => DocumentController::class
    ]);

    // Route::post([
    //     '/sourcesites' => SourceDomainController::class,
    //     '/works' => WorksController::class,
    //     '/practiceType_languages' => LanguagesController::class,
    //     '/practiceType_packagetools' => PackagetoolsController::class,
    //     '/practiceType_environments' => EnvironmentsController::class,
    //     '/practiceType_frameworks' => FrameworksController::class,
    //     '/documents' => DocumentController::class
    // ]);
});

Route::get('test', [GitInfoController::class, 'GetRepos']);
Route::get('test1', function () {
    return view('test');
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
