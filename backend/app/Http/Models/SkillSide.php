<?php

namespace  App\Http\Models;

use Illuminate\Database\Eloquent\{
    Model,SoftDeletes
};

class SkillSide extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'ss_created_at';
    const UPDATED_AT = 'ss_updated_at';
    const DELETED_AT = 'ss_deleted_at';

    protected $dates = [
        'ss_created_at','ss_updated_at','ss_updated_at'
    ];

    protected $fillable = [
        'ss_name',
    ];

    protected $table = 'skill_side';
    protected $primaryKey = 'ss_id';
}
