<?php

namespace App\Models\Resourcemodels;

use Illuminate\Database\Eloquent\Model;

use App\Models\Backgroundmodels\Sourcedomain;
use App\Models\Problemmodels\Environment;
use App\Models\Problemmodels\Framework;
use App\Models\Problemmodels\Language;
use App\Models\Problemmodels\Packagetool;
use App\Models\ResourceAuthorize;
use App\Traits\InstancesInit;

class Resource extends Model
{
    use InstancesInit;

    protected $fillable = [
        'resource_title',
        'resource_domain_id',
        'resource_note',
        'resource_location',
        'resource_content_language',
        'resource_status',
        'resource_creation_date',
        'resource_updated_date'
    ];

    // from domain
    public function authorize()
    {
        return $this->belongsTo(ResourceAuthorize::class, 'resource_domain_id');
    }

    //is about languages
    public function languages()
    {
        return $this->morphedByMany(Language::class, 'resourceabout');
    }

    //is about packagetools
    public function packagetools()
    {
        return $this->morphedByMany(Packagetool::class, 'resourceabout');
    }

    //is about frameworks
    public function frameworks()
    {
        return $this->morphedByMany(Framework::class, 'resourceabout');
    }

    //is about environments
    public function environments()
    {
        return $this->morphedByMany(Environment::class, 'resourceabout');
    }
}
