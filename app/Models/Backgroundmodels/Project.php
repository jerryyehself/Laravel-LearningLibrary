<?php

namespace App\Models\Backgroundmodels;

use App\Models\CentralPivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Problemmodels\Environment;
use App\Models\Problemmodels\Framework;
use App\Models\Problemmodels\Language;
use App\Models\Problemmodels\Packagetool;
use App\Models\ProjectElement;
use App\Models\Resourcemodels\Resource;
use Carbon\Carbon;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'project_name',
        'project_version',
        'project_description',
        'git_repository_id',
        'git_repository_name',
        'maintained',
        'still_maintain',
        'release_url',
        'release_domain_id',
        'repo_created_at',
        'repo_updated_at',
    ];

    // protected $appends = ['project_elements'];

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

    // has project elements
    public function projectElements()
    {
        return $this->hasMany(ProjectElement::class);
    }

    public function latestElements()
    {
        $latestDate = $this->projectElements()
            ->latest('created_at')
            ->value('created_at');

        return $this->projectElements()
            ->whereDate('created_at', $latestDate)
            ->select('element_name')
            ->distinct();
    }

    public function scopeWithElementSearch($query)
    {
        return $query->with(['latestElements' => function ($query) {
            $query->select('project_id', 'element_name')->distinct();
        }])
            ->select('project_name', 'id', 'git_repository_name');
    }

    public function relations()
    {
        return $this->hasMany(CentralPivot::class, 'object_id');
    }
}
