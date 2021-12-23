<?php

namespace App;
use App\Customer; // 追加

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = ['customer_id', 'title', 'start', 'end', 'color'];
    
    /**
     * この投稿を所有する顧客（ Customerモデルとの多対1の関係を定義）
     */
    public function customer()
    {
      return $this->belongsTo(Customer::class);
    }
    
    
}
