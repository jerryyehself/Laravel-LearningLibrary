<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instantiations extends MorphPivot
{
    use SoftDeletes;

    protected $table = 'instantiations';

    protected $fillable = [
        'instantiated_type',
        'instantiated_id',
        'instance_type',
        'instance_id',
        'sort_info'
    ];

    public function deleteRelations()
    {
        return $this->delete();
    }

    public function deletedRelations() {}
}
