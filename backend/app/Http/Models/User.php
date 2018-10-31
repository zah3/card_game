<?php
namespace App\Http\Models;

use App\Http\Helpers\Guard;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\{
    Collection,Facades\Auth,Facades\DB
};
use Laravel\Passport\HasApiTokens;



class User extends Authenticatable
{
    use HasApiTokens,Notifiable,SoftDeletes;

    const MESSAGE_USER_SAVED = 'User saved successfully';

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
        return $this->belongsToMany(Card::class,UserCards::TABLE_NAME,'user_id','card_id');
    }

    /**
     * @return UserCards
     */
    public function cards() : Collection {
        $user = Auth::guard(Guard::API)->user();
        return UserCards::query()->where([UserCards::TABLE_NAME. '.user_id' => $user->id])->get();
    }
    /*END RELATIONS*/

    public function activation() : void {
        $this->is_active = TRUE;
        $this->activation_token = '';
        $this->save();
    }

    /**
     * @param array $options
     * @return string
     */
    public function save(array $options = []) : string {
        DB::beginTransaction();
        try{
            parent::save($options);
        }catch( \Exception | \Throwable $exception){
            DB::rollBack();
            return $exception->getMessage();
        }
        DB::commit();
        return self::MESSAGE_USER_SAVED;
    }

    public function setCredentialsForLogin(Request $request) : array{
        $credentials = [];
        return $credentials;
    }


}