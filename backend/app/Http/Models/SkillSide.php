<?php

namespace  App\Http\Models;

use Illuminate\Database\Eloquent\{
    Model,SoftDeletes
};

class SkillSide extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    protected $dates = [
        'created_at',
        'updated_at',
        'updated_at'
    ];

    protected $fillable = [
        'name',
    ];

    protected $table = 'skill_sides';
    protected $primaryKey = 'id';

    public function type(){
        return $this->belongsTo(Type::class,'type_id','id');
    }
}
