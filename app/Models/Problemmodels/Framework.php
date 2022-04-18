<?php

namespace App\Models\Problemmodels;

use App\Models\Resourcemodels\Resource;
use App\Models\Problemmodels\Language;
use App\Models\Problemmodels\Packagetool;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Framework extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'framework_name',
        'version'
    ];
    public $timestamps = false;
    // has resources
    public function resources()
    {
        return $this->morphToMany(Resource::class, 'resourceabout');
    }

    // has packagetools
    public function packagetools()
    {
        return $this->morphToMany(Packagetool::class, 'packageusage');
    }

    // be used in projects
    public function projects()
    {
        return $this->morphedByMany(Project::class, 'frameworkusage');
    }

    //based on languages
    public function languages()
    {
        return $this->morphToMany(Language::class, 'languageusage');
    }
}
