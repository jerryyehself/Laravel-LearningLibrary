<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;

class QType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Q',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'bbbb'
        ];
    }
}
