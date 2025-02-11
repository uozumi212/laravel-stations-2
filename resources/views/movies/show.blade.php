<h2>映画詳細画面</h2>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h3>タイトル：{{ $movie->title }}</h3>
<img src="{{ $movie->image_url }}" alt="{{ $movie->title }}">
<p>公開年：{{ $movie->published_year }}</p>
@foreach($schedules as $schedule)
    <p>開始時間：{{ \Carbon\Carbon::parse($schedule->start_time)->format('Y-m-d H:i') }}</p>
    <p>終了時間：{{ \Carbon\Carbon::parse($schedule->end_time)->format('Y-m-d H:i') }}</p>
    <a href="{{ route('movies.schedules.sheets', ['movie_id' => $movie->id, 'scheduleId' => $schedule->id]) . '?date=' . now()->format('Y-m-d') }}">座席を予約する</a>
@endforeach
<p>上映中かどうか：{{ $movie->is_showing ? '上映中' : '上映予定' }}</p>
<p>概要：{{ $movie->description }}</p>
<p>登録日時：{{ $movie->created_at }}</p>
<p>更新日時：{{ $movie->updated_at }}</p>
