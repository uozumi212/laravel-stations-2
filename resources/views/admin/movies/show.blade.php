<h1>管理者映画詳細ページ</h1>

<h2>映画名：{{ $movie->title }}</h2>
<img src="{{ $movie->image_url }}" alt="{{ $movie->title }}">
<p>公開年：{{ $movie->published_year }}</p>
<p>上映中かどうか：{{ $movie->is_showing ? '上映中' : '上映予定' }}</p>
    @foreach($screens as $screen)
        <p>スクリーン名：{{ $screen->name ?? '未登録' }}</p>
    @endforeach
@foreach($schedules as $schedule)
    <p>開始時刻：<a href="{{ route('admin.schedules.show', $schedule->id) }}">{{ \Carbon\Carbon::parse($schedule->start_time)->format('Y-m-d H:i:s') }}</a></p>
    <p>終了時刻：<a href="{{ route('admin.schedules.show', $schedule->id) }}">{{ \Carbon\Carbon::parse($schedule->end_time)->format('Y-m-d H:i:s') }}</a></p>
    <a href="{{ route('admin.schedules.edit', $schedule->id) }}">スケジュール編集</a>
@endforeach
<p>概要：{{ $movie->description }}</p>
<p>登録日時：{{ $movie->created_at }}</p>
<p>更新日時：{{ $movie->updated_at }}</p>

<a href="{{ route('admin.movies.schedules.create', ['id' => $movie->id]) }}">スケジュール新規登録</a>
