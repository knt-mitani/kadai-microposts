<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\User;

class Micropost extends Model
{
    use HasFactory;
    
    protected $fillable = ['content'];
    
    /**
     * この投稿を所有するユーザ。(Userモデルとの関係を定義)
    **/
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function favorite_users()
    {
        return $this->belogsToMany(Micropost::class, 'favorites', 'id', 'micropost_id')->withTimestamps();
    }
    
    /**
     * $$micropostIdで指定された投稿をお気に入り登録する
     *
     * @param  int  $micropostId
     * @return bool
     */
    public function favorite($micropostId)
    {
        $user = new User;
        $exist = $user->is_favoriting(Auth::id(), $micropostId);
        // $its_me = $this->id == $micropostId;
        // var_dump($its_me);
        // exit();
        // ↓必要なのか検討する
        // $its_me = $this->id == $userId
        if($exist) {
            return false;
        } else {
            // var_dump('fasdjf;lasjdfl;kjasdf;');
            // exit();
            // $user = User::findOrFail(Auth::id());

            // \DB::enableQueryLog();
            $this->favorite_users()->attach($micropostId);
            // dd(\DB::getQueryLog());
            
            return true;
        }
    }
    
}
