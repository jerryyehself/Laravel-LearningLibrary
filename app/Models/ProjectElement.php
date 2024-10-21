<?php

namespace App\Models;

use App\Models\Backgroundmodels\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectElement extends Model
{
    // use SoftDeletes;

    protected $fillable = [
        'project_id',
        'element_name',
        'element_ver'
    ];

    // belongs to many projects
    public function projects()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id')
            ->select(
                'id',
                'project_name',
                'git_repository_name'
            );
    }
}
