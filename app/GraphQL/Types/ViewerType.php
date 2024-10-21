<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ViewerType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Viewer',
        'description' => 'GitHub viewer information',
    ];

    public function fields(): array
    {
        return [
            'login' => [
                'type' => Type::string(),
                'description' => 'The login name of the viewer',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The real name of the viewer',
            ],
            'avatarUrl' => [
                'type' => Type::string(),
                'description' => 'The avatar URL of the viewer',
            ],
            // 添加其他你想獲取的欄位
        ];
    }
}
