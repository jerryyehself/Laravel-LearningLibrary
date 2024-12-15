<?php

namespace App\Traits;

use App\Models\CentralPivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * inital instance models
 */
trait InstancesInit
{
    use HasFactory, SoftDeletes;

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
