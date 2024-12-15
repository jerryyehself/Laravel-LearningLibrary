<?php

namespace App\Models;

use App\Models\Backgroundmodels\Project;
use App\Models\Problemmodels\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class CentralPivot extends MorphPivot
{
    use SoftDeletes;

    protected $table = 'central_pivot';

    protected $fillable = [
        'subject_type',
        'subject_id',
        'object_type',
        'object_id',
        'sort_info'
    ];

    public function deleteRelations()
    {
        return $this->delete();
    }

    public function deletedRelations() {}
}
