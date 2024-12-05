<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResourcesInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'resource_type',
        'resource_name',
        'resource_url',
        'resource_description',
        'resource_status',
    ];

    public function isResouceOf($backgroudModel)
    {
        return $this->morphedByMany(
            $backgroudModel,
            'subject',
            'central_pivot',
            'subject_id',
            'object_id'
        )
            ->using(CentralPivot::class)
            ->wherePivot('object_type', $backgroudModel)
            ->wherePivot('deleted_at', null)
            ->withPivot('id')
            ->withTimestamps();
    }
}
