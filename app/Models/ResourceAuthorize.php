<?php

namespace App\Models;

use App\Models\Resourcemodels\Resource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResourceAuthorize extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'resource_domain_url',
        'resource_domain_name',
        'resource_domain_note',
        'resource_domain_status'
    ];

    public function resources()
    {
        return $this->hasMany(Resource::class, 'resource_domain_id');
    }
}
