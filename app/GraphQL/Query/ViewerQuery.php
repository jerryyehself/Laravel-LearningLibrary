<?php

namespace App\GraphQL\Query;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Illuminate\Support\Facades\Http;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ViewerQuery extends Query
{
    protected $attributes = [
        'name' => 'viewer',
    ];

    public function type(): Type
    {
        return GraphQL::type('Viewer');
    }

    public function resolve($root, $args)
    {

        // $response = Http::withToken(config('services.github.token'))->post('https://api.github.com/graphql', [
        //     'query' => '
        //         viewer {
        //             repositories(
        //                 orderBy:{
        //                     field:UPDATED_AT,
        //                     direction:DESC
        //                 },
        //                 first: 100,
        //                 privacy:PUBLIC
        //             ) {
        //                 nodes {
        //                     name,
        //                     languages(first:100){
        //                         nodes{
        //                             name,
        //                             color
        //                         }
        //                     }
        //                 },
        //             totalCount
        //             }
        //         }
        //     ',
        // ]);

        dd('aa');

        $data = $response->json();
        dd($data);
        // 返回 viewer 的數據
        return $data['data']['viewer'];
    }
}
