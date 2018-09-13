<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\{
    Model,SoftDeletes
};

class Type extends Model
{
    use SoftDeletes;

    const CREATED_AT = self::PREFIX.'created_at';
    const UPDATED_AT = self::PREFIX.'updated_at';
    const DELETED_AT = self::PREFIX.'deleted_at';

    public const PREFIX = 't_';

    protected $dates = [
        self::PREFIX.'created_at',
        self::PREFIX.'updated_at',
        self::PREFIX.'deleted_at'
    ];

    protected $fillable = [
        self::PREFIX.'name'
    ];

    protected $table = 'types';
    protected $primaryKey = self::PREFIX.'id';

    public function skillSide(){
      //  return $this->hasMany(SkillSide::class,);
    }

    public function skillMain(){
        //return $this->hasMany(SkillMain::class,self::PREFIX.'');
    }

    public function cards(){
        return $this->hasMany(Card::class,Type::PREFIX.'type_id',self::PREFIX.'id');
    }
}
