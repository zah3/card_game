<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\{
    Model, Relations\HasMany, SoftDeletes
};

class Type extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'name'
    ];

    protected $table = 'types';
    protected $primaryKey = 'id';

    public function skillSide(){
      //  return $this->hasMany(SkillSide::class,);
    }

    public function skillMain(){
        //return $this->hasMany(SkillMain::class,self::PREFIX.'');
    }

    public function cards() : HasMany {
        return $this->hasMany(Card::class,'type_id','id');
    }
}
