<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

// class Doctor extends Model
// {
//     /**
//      * The attributes that should be cast to native types.
//      *
//      * @var array
//      */
//     protected $casts = [
//         'created_at' => 'datetime:Y-m-d',
//         'is_ban' => 'boolean',
//     ];

//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var array
//      */
//     protected $fillable = [
//         'name', 'email', 'password', 'national_id', 'avatar', 'pharmacy_id'
//     ];
// }

use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class Doctor extends Authenticatable implements BannableContract
{
    use Bannable,Billable;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'is_ban' => 'boolean',
    ];

    protected $guard = 'doctor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'national_id', 'avatar', 'pharmacy_id', 'is_ban', 'banned_at'
    ];

    public function user()
    {
      return $this->morphOne('App\User', 'profile');
    }

    public function pharmacy() {
        return $this->belongsTo('App\Pharmacy');
    }
}
