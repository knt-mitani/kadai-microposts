<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Micropost;

class FavoritesController extends Controller
{
    /**
     * ユーザがお気に入り登録するアクション
     *
     * @param  $micropostId  投稿記事のid
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
     * ユーザのお気に入りを削除するアクション
     *
     * @param  $micropostId  投稿記事のid
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
