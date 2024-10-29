<?php

namespace App\Models;

use App\Models\Backgroundmodels\Project;
use App\Models\Problemmodels\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CentralPivot extends Model
{
    use SoftDeletes;

    protected $table = 'central_pivot';

    protected $fillable = [
        'subject_type',
        'subject_id',
        'object_type',
        'object_id',
    ];

    public function languages()
    {
        return $this->hasMany(Language::class, 'id', 'object_id')
            ->whereHas('relations', function ($query) {
                $query->where('object', 'Language');
            });
    }
}
