<?php

namespace GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use \GraphQL\Type\Definition\Type;

class ReposType extends GraphQLType
{
    protected $attributes = [
        'name'        => 'Repos',
        'description' => '儲存庫資料',
        // 'model'       => User::class,
    ];

    public function fields(): array
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => '儲存庫名稱'
            ],
            // 'email' => [
            //     'type' => Type::nonNull(Type::string()),
            //     'description' => '電子信箱'
            // ],
        ];
    }
}
