<?php

namespace App\GraphQL\Queries;

use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Http;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ReposQuery extends Query
{
    protected $attributes = [
        'name' => 'ReposQuery',
        'descrption' => '儲存庫查詢'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('ReposType')); // 這裡是返回儲存庫名稱的類型
    }

    public function args(): array
    {
        return [
            'limit' => [
                'name' => 'limit',
                'type' => Type::int(),
                'defaultValue' => 100,
            ],
            // 'limit' => [
            //     'name' => 'limit',
            //     'type' => Type::int(),
            //     'defaultValue' => 100,
            // ],
        ];
    }

    public function resolve($root, $args)
    {
        $token = config('services.github.token');
        $query = [
            'query' => '{
                viewer {
                    repositories(first: ' . $args['limit'] . ') {
                        nodes {
                            name
                        }
                    }
                }
            }',
        ];

        $response = Http::withToken($token)
            ->post('https://api.github.com/graphql', $query);

        $response->throw();

        // 從回應中提取儲存庫名稱
        return collect($response->json('data.viewer.repositories.nodes'))
            ->pluck('name')
            ->toArray();
    }
}
