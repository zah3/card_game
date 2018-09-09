<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\{
    Model,SoftDeletes
};

class Type extends Model
{
    use SoftDeletes;

    const CREATED_AT = 't_created_at';
    const UPDATED_AT = 't_updated_at';
    const DELETED_AT = 't_deleted_at';

    protected $dates = [
        't_created_at','t_updated_at','t_deleted_at'
    ];

    protected $fillable = [
        't_name'
    ];

    protected $table = 'types';
    protected $primaryKey = 't_id';




}
