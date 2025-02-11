<h1>管理者映画スケジュール投稿ページ</h1>
<h2>{{ $movie->title }}</h2>

@if(session('errors'))
    <div class="alert alert-danger">
        <ul>
            @foreach(session('errors')->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<form method="post" action="{{ route('admin.schedules.store', ['id' => $movie->id]) }}">
    @csrf
    <input type="hidden" name="movie_id" value="{{ $movie->id }}">
    <label for="screen_id">スクリーン：</label>
    <select name="screen_id" id="screen_id">
        @foreach($screens as $screen)
            <option value="{{ $screen->id }}">{{ $screen->name }}</option>
        @endforeach
    </select><br>
    <label for="start_time">開始時刻：</label>
    <input type="date" id="start_time_date" name="start_time_date" required>
    <input type="time" id="start_time_time" name="start_time_time" required><br>
    <label for="end_time">終了時刻</label>
    <input type="date" id="end_time_date" name="end_time_date" required>
    <input type="time" id="end_time_time" name="end_time_time" required><br>
    <button type="submit">登録する</button>
</form>
