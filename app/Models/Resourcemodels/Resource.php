<?php

namespace App\Models\Resourcemodels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Backgroundmodels\Sourcedomain;

use App\Models\Problemmodels\Environment;
use App\Models\Problemmodels\Framework;
use App\Models\Problemmodels\Language;
use App\Models\Problemmodels\Packagetool;

class Resource extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'sourcedomain_id',
        'location',
        'content_language',
        'creation_date',
        'last_answer_date',
        // 'note'

    ];

    // from domain
    public function sourcedomain()
    {
        return $this->belongsTo(Sourcedomain::class);
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
