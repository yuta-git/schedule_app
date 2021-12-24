<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'age_flag', 'birthday_flag',
        'address_flag', 'hometown_flag', 'charactor_flag',
        'blood_type_flag', 'occupancy_flag', 'hobby_flag',
        'skill_flag', 'dayoff_flag', 'favorite_food_flag',
        'dislike_food_flag', 'marriage_flag', 'children_flag',
        'lover_flag', 'mail_flag', 'telphone_flag', 'company_name_flag',
        'memo_flag',
    ];

     /**
     * 関連するユーザーインスタンスを取得
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
