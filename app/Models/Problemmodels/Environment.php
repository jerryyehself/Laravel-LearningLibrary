<?php

namespace App\Models\Problemmodels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Backgroundmodels\Project;

use App\Models\Resourcemodels\Resource;

use App\Models\Problemmodels\Language;

class Environment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'environment_name',
        'version'
    ];

    // has resources
    public function resources()
    {
        return $this->morphToMany(Resource::class, 'resourceabout');
    }

    // has languages
    public function languages()
    {
        return $this->morphToMany(Language::class, 'languageusage');
    }

    // be used in projects
    public function projects()
    {
        return $this->morphedByMany(Project::class, 'environmentusage');
    }
}
