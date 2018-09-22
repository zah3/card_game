<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\{
    Model, Relations\BelongsTo, SoftDeletes
};

class Card extends Model
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
        'level',
        'star',
        'name',
        'hp',
        'def',
        'critical',
        'critical_chance',
        'block_chance',
        'accuracy',
        'reflection',
    ];

    protected $table = 'cards';
    protected $primaryKey = 'id';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type() : BelongsTo {
        return $this->belongsTo(Type::class,'type_id','id');
    }
}
