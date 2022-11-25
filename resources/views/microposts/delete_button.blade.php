@if (Auth::id() == $micropost->user_id)
    {{-- 投稿削除ボタンのフォーム --}}
    <form method="POST" action="{{ route('microposts.destroy', $micropost->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-error btn-sm normal-case" 
            onclick="return confirm('Delete id = {{ $micropost->id }} ?')">Delete</button>
    </form>
@endif