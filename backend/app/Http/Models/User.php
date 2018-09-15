<?php
namespace App\Http\Models;

use App\Http\Helpers\Guard;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable,SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_active','activation_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','activation_token'
    ];

    /*RELATIONS*/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function baseCards() : BelongsToMany {
        return $this->belongsToMany(Card::class,UserCards::TABLE_NAME,'uc_user_id','uc_card_id','id','c_id');
    }

    /**
     * @return UserCards
     */
    public function cards() : Collection {
        $user = Auth::guard(Guard::API)->user();
        return UserCards::query()->where([UserCards::PREFIX . 'user_id' => $user->id])->get();
    }
    /*END RELATIONS*/


}