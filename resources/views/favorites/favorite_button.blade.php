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