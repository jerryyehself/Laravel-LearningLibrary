<?php

namespace App\Models\Backgroundmodels;

use App\Models\CentralPivot;
use App\Models\Images;
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
use PhpParser\Node\Expr\Cast\Object_;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'project_name',
        'project_name_cn',
        'project_version',
        'project_description',
        'git_repository_id',
        'maintained',
        'still_maintain',
        'display_status',
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
        return $this->relations(Framework::class);
    }

    // using environments
    public function environments()
    {
        return $this->relations(Environment::class);
    }

    // using packagetools
    public function packagetools()
    {
        return $this->relations(Packagetool::class);
    }

    // using languages
    public function Usinglanguages()
    {
        return $this->relations(Language::class);
        // return $this->morphedByMany(
        //     Language::class,
        //     'object',
        //     'central_pivot',
        //     'object_id',
        //     'subject_id'
        // )
        //     ->using(CentralPivot::class)
        //     ->wherePivot(
        //         'object_type',
        //         Language::class
        //     )
        //     ->wherePivot('deleted_at', null)
        //     ->withPivot('id')
        //     ->withTimestamps();
    }

    public function hasImg()
    {
        return $this->morphToMany(
            Images::class,
            'subject',
            'central_pivot',
            'subject_id',
            'object_id'
        )
            ->using(CentralPivot::class)
            ->wherePivot('object_type', Images::class)
            ->wherePivot('deleted_at', null)
            ->withPivot('id', 'sort_info')
            ->withTimestamps()
            ->orderByPivot('sort_info');
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

    //查詢資源
    public function scopeWithElementSearch($query)
    {
        return $query->with(['latestElements' => function ($query) {
            $query->select('project_id', 'element_name')->distinct();
        }])
            ->select('project_name', 'id');
    }

    private function relations($model)
    {
        return $this->morphedByMany(
            $model,
            'object',
            'central_pivot',
            'object_id',
            'subject_id'
        )
            ->using(CentralPivot::class)
            ->wherePivot(
                'object_type',
                $model
            )
            ->wherePivot('deleted_at', null)
            ->withPivot('id')
            ->withTimestamps();;
    }
}
