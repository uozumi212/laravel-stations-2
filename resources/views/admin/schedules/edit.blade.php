<h1>管理者スケジュール編集ページ</h1>
<h2>作品名：{{ $movie->title }}</h2>

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

<form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <input type="hidden" name="movie_id" value="{{ $movie->id }}">

    <label for="">スクリーン名</label>
    <select name="screen_id" id="screen_id">
        @foreach($screens as $screen)
            <option value="{{ $screen->id }}" @if($screen->id == $schedule->screen_id) selected @endif>{{ $screen->name }}</option>
        @endforeach
    </select><br>

    <label for="start_time">開始時刻：</label>
    <input type="date" id="start_time_date" name="start_time_date" value="{{ \Carbon\Carbon::parse($schedule->start_time)->format('Y-m-d') }}" required>
    <input type="time" id="start_time_time" name="start_time_time" value="{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}" required><br>

    <label for="end_time">終了時刻：</label>
    <input type="date" id="end_time_date" name="end_time_date" value="{{ \Carbon\Carbon::parse($schedule->end_time)->format('Y-m-d') }}" required>
    <input type="time" id="end_time_time" name="end_time_time" value="{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}" required><br>

    <button type="submit">更新する</button>
</form>

<form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('本当に削除しますか?')">削除する</button>
</form>
