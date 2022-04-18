<?php

namespace App\Models\Backgroundmodels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Problemmodels\Environment;
use App\Models\Problemmodels\Framework;
use App\Models\Problemmodels\Language;
use App\Models\Problemmodels\Packagetool;
use App\Models\Resourcemodels\Resource;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'project_name',
        'project_version',
        'project_description',
        'git_repository_id',
        'maintained',
        'still_maintain',
        'release_url',
        'release_domain_id'
    ];

    // from domain
    public function sourcedomain()
    {
        return $this->belongsTo(Sourcedomain::class, 'release_domain_id');
    }

    // using frameworks
    public function frameworks()
    {
        return $this->morphToMany(Framework::class, 'frameworkusage');
    }

    // using environments
    public function environments()
    {
        return $this->morphToMany(Environment::class, 'environmentusage');
    }

    // using packagetools
    public function packagetools()
    {
        return $this->morphToMany(Packagetool::class, 'packagetoolusage');
    }

    // using languages
    public function languages()
    {
        return $this->morphToMany(Language::class, 'languageusage');
    }

    // has resources
    public function resources()
    {
        return $this->morphToMany(Resource::class, 'resourceusage');
    }
}
