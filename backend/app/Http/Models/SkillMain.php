<?php

namespace  App\Http\Models;

use Illuminate\Database\Eloquent\{
    Model,SoftDeletes
};

class SkillMain extends Model
{
    use SoftDeletes;

    const CREATED_AT = self::PREFIX.'created_at';
    const UPDATED_AT = self::PREFIX.'updated_at';
    const DELETED_AT = self::PREFIX.'deleted_at';

    public const PREFIX = 'sm_';

    protected $dates = [
        self::PREFIX.'created_at',
        self::PREFIX.'updated_at',
        self::PREFIX.'updated_at'
    ];

    protected $fillable = [
        self::PREFIX.'name',
    ];

    protected $table = 'skill_mains';
    protected $primaryKey = self::PREFIX.'id';

    public function type(){
        return $this->belongsTo(Type::class);
    }
}
