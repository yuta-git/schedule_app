<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Customer; // 追記

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // Customerモデルと1対多のリレーションを張る
    public function customers()
    {
        // Customerモデルのデータを引っ張てくる
        return $this->hasMany(Customer::class);
    }
    
    /**
     * 関連するフラグインスタンスを取得
     */
    public function flag()
    {
        return $this->hasOne('App\Flag');
    }    
    
}
