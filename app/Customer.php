<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User; // 追加

class Customer extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'kana_name', 'thumbnail', 'gender', 'age', 'birthday',
        'address', 'hometown', 'feature', 'blood_type', 'job', 'hobby',
        'skill', 'dayoff', 'favorite_food', 'dislike_food', 'marriage',
        'children', 'lover', 'email', 'telephone', 'company_name', 
        'memo', 'favorite_flag', 'delete_flag'
    ];
    
    // Userモデルと多対1のリレーションを張る
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function is_delete() {
        $customer = Customer::where('id', $this->id)->where('delete_flag', 1)->get()->first();
        
        if($customer !== null) {
            return true;
        } else {
            return false;
        }
    }
    
    public function is_favorite(){
        $customer = Customer::where('id', $this->id)->where('favorite_flag', 1)->get()->first();
        // dd($customer);
        if($customer !== null){
            return true;
        }else{
            return false;
        }
    }
    
        
}
