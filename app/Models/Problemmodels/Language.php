<?php

namespace App\Models\Problemmodels;

use App\Models\Backgroundmodels\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\CentralPivot;
use App\Models\Resourcemodels\Resource;

use App\Models\Problemmodels\Framework;
use App\Models\Problemmodels\Environment;
use App\Models\Problemmodels\Packagetool;

class Language extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'language_name',
        'version'
    ];
    public $timestamps = false;

    public function relations()
    {
        return $this->hasMany(CentralPivot::class, 'object_id');
    }

    public function hasInstanceProjects()
    {
        return $this->morphToMany(
            Project::class,
            'object',
            'central_pivot',
            'subject_id',
            'object_id'
        );
    }

    // has resources
    public function resources()
    {
        return $this->morphToMany(Resource::class, 'resourceabout',);
    }

    // has related use
    public function frameworks()
    {
        return $this->morphedByMany(Framework::class, 'languageusage');
    }

    public function environments()
    {
        return $this->morphedByMany(Environment::class, 'languageusage');
    }

    public function packagetools()
    {
        return $this->morphedByMany(Packagetool::class, 'languageusage');
    }
}
