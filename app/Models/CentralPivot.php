<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CentralPivot extends Model
{
    use SoftDeletes;

    protected $table = 'central_pivot';

    protected $fillable = [
        'subject',
        'subject_id',
        'object',
        'object_id',
    ];
}
