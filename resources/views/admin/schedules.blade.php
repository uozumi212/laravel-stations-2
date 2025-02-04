<h1>管理者スケジュール一覧</h1>
@foreach($movies as $movie)
<h2>作品ID：{{ $movie->id }}</h2>
<h2>作品名：{{ $movie->title }}</h2>
    @foreach($movie->schedules as $schedule)
        <p>開始時刻：<a href="{{ route('admin.schedules.edit', $schedule->id) }}">{{ \Carbon\Carbon::parse($movie->start_time)->format('Y-m-d H:i') }}</a></p>
        <p>終了時刻：<a href="{{ route('admin.schedules.edit', $schedule->id) }}">{{ \Carbon\Carbon::parse($movie->end_time)->format('Y-m-d H:i') }}</a></p>
    @endforeach
@endforeach
