<h1>管理者スケジュール詳細ページ</h1>

<h2>作品名：{{ $movie->title }}</h2>
<p>開始時刻：{{ \Carbon\Carbon::parse($schedule->start_time)->format('Y-m-d H:i') }}</p>
<p>終了時刻：{{ \Carbon\Carbon::parse($schedule->end_time)->format('Y-m-d H:i') }}</p>
