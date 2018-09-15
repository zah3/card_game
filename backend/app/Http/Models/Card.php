<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\{
    Model,SoftDeletes
};

class Card extends Model
{
    use SoftDeletes;

    const CREATED_AT = self::PREFIX.'created_at';
    const UPDATED_AT = self::PREFIX.'updated_at';
    const DELETED_AT = self::PREFIX.'deleted_at';

    public const PREFIX = 'c_';

    protected $dates = [
        self::PREFIX.'created_at',
        self::PREFIX.'updated_at',
        self::PREFIX.'updated_at'
    ];

    protected $fillable = [
        self::PREFIX.'level',
        self::PREFIX.'star',
        self::PREFIX.'name',
        self::PREFIX.'hp',
        self::PREFIX.'def',
        self::PREFIX.'critical',
        self::PREFIX.'critical_chance',
        self::PREFIX.'block_chance',
        self::PREFIX.'accuracy',
        self::PREFIX.'reflection',
    ];

    protected $table = 'cards';
    protected $primaryKey = self::PREFIX.'id';

    public function type(){
        return $this->belongsTo(Type::class,self::PREFIX.'id',Type::PREFIX.'id');
    }
}
