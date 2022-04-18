<?php

namespace App\Models\Problemmodels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Backgroundmodels\Project;

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
    // be used in projects
    public function projects()
    {
        return $this->morphedByMany(Project::class, 'languageusage');
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
