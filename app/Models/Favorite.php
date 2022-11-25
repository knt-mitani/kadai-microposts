<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['user_id', 'micropost_id'];
    
    // Favoriteテーブル⇒userテーブルに対して1対多
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Favoriteテーブル⇒Miropostsテーブルに対して1対多
    public function micropost()
    {
        return  $this->belongsTo(Micropost::class);

    }
}