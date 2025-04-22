<?php

use App\GraphQL\Types\QType;
use App\GraphQL\Types\ViewerType;
use App\Http\Controllers\ChartsDataController;
use App\Http\Controllers\ParserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewParserController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\WorkSearchController;
use App\Http\Resources\DomainResource;
use App\Models\Backgroundmodels\Project;
use App\Models\Backgroundmodels\Sourcedomain;
use App\Models\Problemmodels\Language;
use App\Models\ProjectElement;
use App\Notifications\GitUpdateStatus;
use App\Notify\GitNotifiable;
use App\Service\SaveReposDataService;
use App\View\Components\ElementTags;
use Github\Api\GitData\Tags;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\View;
use Rebing\GraphQL\GraphQL as GraphQLGraphQL;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Str;
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
Route::post(
    'gitChartsData',
    [ChartsDataController::class, 'setChart']
);
Route::post(
    'gitChartsDataa',
    [ChartsDataController::class, 'getLatestLanguageData']
);
// dd();
Route::put(
    'changeEntityDisplay',
    function (Request $request) {
        return redirect()->route(
            "{$request->entity}.update",
            [Str::singular($request->entity) => $request->id]
        );
    }
);

// dd('aa');
Route::post('/addTags', function (Request $request) {
    $model = Str::singular($request->type);
    $nameCol = $model . '_name';
    $tags = DB::table($request->type)
        ->select(['id', $nameCol])
        ->whereNotIn($nameCol, $request->tags)
        ->where(
            $nameCol,
            'like',
            "%{$request->input}%"
        )
        ->get();
    $container = $tags->map(function ($tag) use ($nameCol, $model) {
        $badge = View::make('components.element-tags', ['tag' => $tag->$nameCol, 'delete' => true])->render();
        return ['badge' => $badge, 'name' => $tag->$nameCol, 'value' => "{$model}_{$tag->id}"];
    });
    // dd($container);
    return response($container);
});

Route::get('graphQLtest', function () {
    // $test = new Project;
    // dd($test->find(1)->first()->projectElements->values('element_name'));
    // $queryType = new ObjectType([
    //     'name' => 'Query',
    //     'fields' => [
    //         'customer' => [
    //             'type' => $userType,
    //             'args' => [
    //                 'id' => Type::int(),
    //             ],
    //             'resolve' => function ($root, $args) {
    //                 $returnArray = [];
    //                 foreach ($root as $key => $customer) {
    //                     if ($customer["id"] == $args["id"])
    //                         $returnArray = $customer;
    //                 }
    //                 return $returnArray;
    //             }
    //         ],
    //     ],
    // ]);
    $response = Http::withToken(config('services.github.token'))->post('https://api.github.com/graphql', [
        'query' =>
        new QType([
            'name' => 'viewer',
            'fields' => [
                'repositories' => [
                    // 'type' => new ViewerType,
                    'type' => Type::string(),
                    'arg' => [
                        'message' => Type::nonNull(Type::string())
                    ],
                    'resolve' => function ($root, $args) {
                        return $root['prefix'];
                    }
                ],
            ],
        ])
        //     '
        //     {
        //         viewer {
        //             repositories(
        //                 orderBy: {
        //                     field: UPDATED_AT,
        //                     direction: DESC
        //                 },
        //                 first: 100,
        //                 privacy: PUBLIC
        //             ) {
        //                 nodes {
        //                     name
        //                     languages(first: 100) {
        //                         nodes {
        //                             name
        //                             color
        //                         }
        //                     }
        //                 }
        //                 totalCount
        //             }
        //         }
        //     }
        // ',
    ]);
    // dd($response->json());
    return response()->json($response);
    $test = new SaveReposDataService;
    return $test->saveReposData();
});

Route::post(
    'gitInfos',
    [WorkSearchController::class, 'search']
);

Route::get(
    'mailtest',
    function () {
        $noitfy = new GitNotifiable;
        $noitfy->notify(new GitUpdateStatus());
        return response('send success');
    }
);

Route::get(
    'test',
    function () {
        return Project::with('UsingLanguages')->find(1);
    }
);

// Route::apiResource('/setting', DomainController::class);
Route::get('/setting/domain/{domain}', [DomainController::class, 'show']);
// Route::resource('/insertdomain', NewParserController::class);
//->middleware('responsetype');