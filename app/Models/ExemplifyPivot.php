<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExemplifyPivot extends Model
{
    use SoftDeletes;

    protected $table = 'exemplify_pivot';

    protected $fillable = [
        'subject_type',
        'subject_id',
        'object_type',
        'object_id',
        'sort_info'
    ];

    public function deleteRelations()
    {
        return $this->delete();
    }

    public function deletedRelations() {}
}
