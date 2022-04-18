<?php

namespace App\Models\Problemmodels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Problemmodels\Language;
use App\Models\Resourcemodels\Resource;

class Packagetool extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'packagetool_name',
        'version'
    ];
    public $timestamps = false;
    // has resources
    public function resources()
    {
        return $this->morphToMany(Resource::class, 'resourceabout');
    }

    // be used in framework
    public function frameworks()
    {
        return $this->morphedByMany(Framework::class, 'frameworkusage');
    }

    // be used in projects
    public function projects()
    {
        return $this->morphedByMany(Project::class, 'packagetoolusage');
    }

    // based on languages
    public function languages()
    {
        return $this->morphToMany(Language::class, 'languageusage');
    }
}
