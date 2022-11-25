@if (isset($microposts))
    <ul class="list-none">
        @foreach ($microposts as $micropost)
        <?php 

        
        ?>
            <li class="flex items-center gap-x-2 mb-4">
                {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                <div class="avatar">
                    <div class="w-12 rounded">
                        <img src="{{ Gravatar::get($micropost->user->email) }}" alt="" />
                    </div>
                </div>
                <div>
                    <div>
                        <a class="link link-hover text-info" href="{{ route('users.show', $micropost->user->id) }}">{{ $micropost->user->name }}</a>
                        <span class="text-muted text-gray-500">Id:{{ ($micropost->id) }}</span>
                        <span class="text-muted text-gray-500">posted at {{ $micropost->created_at }}</span>
                    </div>

                    <div>
                        <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                    </div>    
    
                        <div class='flex'>
                            
                            <div>
                                @if (Auth::user()->is_favoriting($micropost->id))
                                    {{-- お気に入り解除ボタンのフォーム --}}
                                    <form method="POST" action="{{ route('favorites.unfavorite', $micropost->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-secondary btn-sm normal-case" 
                                            onclick="return confirm('id = {{ $user->id }} のお気に入りを外します。よろしいですか？')">Unfavorite</button>
                                    </form>
                                @else
                                    {{-- お気に入り登録ボタンのフォーム --}}
                                    <form method="POST" action="{{ route('favorites.favorite', $micropost->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-block btn-sm normal-case">Favolite</button>
                                    </form>
                                @endif
                            </div>
                            
                            <div>
                                @if (Auth::id() == $micropost->user_id)
                                {{-- 投稿削除ボタンのフォーム --}}
                                <form method="POST" action="{{ route('microposts.destroy', $micropost->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-sm normal-case" 
                                        onclick="return confirm('Delete id = {{ $micropost->id }} ?')">Delete</button>
                                </form>
                                @endif
                            </div>
                            
                        </div>

                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $microposts->links() }}
@endif