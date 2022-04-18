<?php

namespace App\Models\Backgroundmodels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Problem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'problem_description',
        'related_resources',
        'related_to_language',
        'related_to_framework',
        'related_to_enviroment',
        'related_to_package',
        'solved_status',
        'problem_note',
    ];
}
