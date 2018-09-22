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

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'level',
        'hp',
        'hp',
        'def',
        'critical',
        'critical_chance',
        'block_chance',
        'accuracy',
        'reflection',
    ];

    protected $primaryKey = 'id';

    protected $table = 'user_cards';

    public const TABLE_NAME = 'user_cards';

//    public function user() : BelongsTo {
//        return $this->belongsTo(User::class,self::PREFIX.'user_id','id');
//    }
}
