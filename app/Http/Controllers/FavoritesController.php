<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Micropost;

class FavoritesController extends Controller
{
    /**
     * ユーザをフォローするアクション。
     *
     * @param  $id  相手ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function store($micropostId)
    {
        $user = \Auth::user();
        if (!$user->is_favoriting($micropostId)) {
            $user->user_microposts()->attach($micropostId);
            
        }
        return back();
    }
    
    /**
     * ユーザをアンフォローするアクション。
     *
     * @param  $id  相手ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function destroy($micropostId)
    {
        $user = \Auth::user();
            var_dump('fasdfa');
        if ($user->is_favoriting($micropostId)) {
            $user->user_microposts()->detach($micropostId);
            // \Auth::user()->unfavorite($micropostId);
        }
        return back();
    }
}
