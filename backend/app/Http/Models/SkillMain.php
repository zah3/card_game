<?php

namespace  App\Http\Models;

use Illuminate\Database\Eloquent\{
    Model,SoftDeletes
};

class SkillMain extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'sm_created_at';
    const UPDATED_AT = 'sm_updated_at';
    const DELETED_AT = 'sm_deleted_at';

    protected $dates = [
        'sm_created_at','sm_updated_at','sm_updated_at'
    ];

    protected $fillable = [
        'sm_name',
    ];

    protected $table = 'skill_main';
    protected $primaryKey = 'sm_id';
}
