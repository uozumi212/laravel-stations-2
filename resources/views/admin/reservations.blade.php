<h1>管理者ユーザー予約一覧</h1>

<a href="{{ route('admin.reservations.create') }}">新規登録</a>

@foreach($reservations as $reservation)
    <a href="{{ route('admin.reservations.edit', $reservation->id) }}">
        <p>作品名：{{ $reservation->schedule->movie->title ?? '未登録' }}</p>
    </a>
    <p>予約ID: {{ $reservation->id }}</p>
    <p>座席：{{ strtoupper($reservation->sheet->row.$reservation->sheet->column)}}</p>
    <p>予約者：{{ $reservation->name }}</p>
    <p>予約者メールアドレス：{{ $reservation->email }}</p>
    <p>日時：{{ $reservation->date }}</p>
    <p>スクリーン名：{{ $reservation->screen->name ?? '未登録' }}</p>
@endforeach
