<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\{
    Model, Relations\BelongsTo, SoftDeletes
};

/**
 * Class UserCards
 * @package App\Http\Models
 */
class UserCards extends Model
{
    use SoftDeletes;

    const CREATED_AT = self::PREFIX.'created_at';
    const UPDATED_AT = self::PREFIX.'updated_at';
    const DELETED_AT = self::PREFIX.'deleted_at';

    public const PREFIX = 'uc_';

    protected $dates = [
        self::PREFIX.'created_at',
        self::PREFIX.'updated_at',
        self::PREFIX.'deleted_at'
    ];

    protected $fillable = [
        self::PREFIX.'level',
        self::PREFIX.'hp',
        self::PREFIX.'hp',
        self::PREFIX.'def',
        self::PREFIX.'critical',
        self::PREFIX.'critical_chance',
        self::PREFIX.'block_chance',
        self::PREFIX.'accuracy',
        self::PREFIX.'reflection',
    ];

    protected $primaryKey = self::PREFIX.'id';

    protected $table = 'user_cards';

    public const TABLE_NAME = 'user_cards';

//    public function user() : BelongsTo {
//        return $this->belongsTo(User::class,self::PREFIX.'user_id','id');
//    }
}
