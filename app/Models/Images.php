<?php

namespace App\Models;

use App\Models\Backgroundmodels\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Images extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'img_name',
        'img_route',
        'img_descript'
    ];

    public function isImgOf()
    {
        $this->morphedByMany(
            Project::class,
            'subject',
            'central_pivot',
            'subject_id',
            'object_id'
        );
    }
}
