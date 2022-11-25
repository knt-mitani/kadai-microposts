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
                        {{-- micropostを表示 --}}
                        <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                    </div>
                    <div class='flex'>
                        <div>
                            {{-- お気に入りボタン --}}
                            @include('favorites.favorite_button')
                        </div>
                        <div>
                            {{-- micropost削除ボタン(自分の投稿分のみ表示) --}}
                            @include('microposts.delete_button')
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $microposts->links() }}
@endif