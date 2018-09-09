<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\{
    Model,SoftDeletes
};

class Card extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'c_created_at';
    const UPDATED_AT = 'c_updated_at';
    const DELETED_AT = 'c_deleted_at';

    protected $dates = [
        'c_created_at','c_updated_at','c_updated_at'
    ];

    protected $fillable = [
        'c_name',
        'c_hp',
        'c_hp',
        'c_def',
        'c_critical',
        'c_critical_chance',
        'c_block_chance',
        'c_accuracy',
        'c_reflection',
    ];

    protected $table = 'cards';
    protected $primaryKey = 'c_id';
}
