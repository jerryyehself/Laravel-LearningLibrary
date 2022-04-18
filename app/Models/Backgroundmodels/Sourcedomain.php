<?php

namespace App\Models\Backgroundmodels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Resourcemodels\Resource;

class Sourcedomain extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'domain_url',
        'domain_name',
        'domain_api',
        'domain_logo'
    ];

    public function resources()
    {
        return $this->hasMany(Resource::class, 'domain_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'release_domain_id');
    }
}
