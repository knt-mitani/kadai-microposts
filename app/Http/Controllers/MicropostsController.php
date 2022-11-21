<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Micropost;

class MicropostsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            //認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿一覧を作成日付の降順で取得
            $microposts = $user->feed_microposts()->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'user' => $user,
                'microposts' => $microposts,
            ];
        }
        
        // dashboardビューでそれらを表示
        return view('dashboard', $data);
    }
    
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|max:255',    
        ]);
        
        // 認証済みユーザ(閲覧者)の投稿として作成(リクエストされた値を元に作成)
        $request->user()->microposts()->create([
            'content' => $request->content,
        ]);
        
        // 前のURLへリダイレクトする
        return back();
    }
    
    public function destroy($id)
    {
        // id値で投稿を検索して取得
        $microposts = \App\Models\Micropost::findOrFail($id);
        
        // 認証済みユーザ(閲覧者)画素の投稿の所有者である場合は投稿を削除
        if(\Auth::id() === $microposts->user_id) {
            $microposts->delete();
            return back()
                ->with('success', 'Delete Successful');
        }
        
        // 前のURLへリダイレクトさせる
        return back()
            ->with('Delete Failed');
    }
}