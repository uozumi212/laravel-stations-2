<h1>管理者予約編集</h1>

@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endforeach
@endif

<form method="POST" action="{{ route('admin.reservations.update', $reservation->id) }}">
    @csrf
    @method('PATCH')
        <select name="movie_id" id="">
           @foreach($movies as $movie)
            <option value="{{ $movie->id }}">{{ $movie->title }}"></option>
            @endforeach
        </select><br>
        <select name="schedule_id" id="">
            @foreach($schedules as $schedule)
                <option value="{{ $schedule->id }}">{{ $schedule->start_time }}</option>
            @endforeach
        </select><br>
        <select name="sheet_id" id="">
            @foreach($sheets as $sheet)
            <option value="{{ $sheet->id }}">{{ $sheet->row }}-{{ $sheet->column  }}</option>
            @endforeach
        </select><br>

    <input type="date" name="date" value="{{ old('date', $reservation->date) }}"><br>
    <label for="name">予約者氏名:</label>
    <input type="text" id="name" name="name" value="{{ old('name', $reservation->name) }}"><br>
    <label for="email">予約者メールアドレス:</label>
    <input type="email" id="email" name="email" value="{{ old('email', $reservation->email) }}"><br>
    <input type="submit" value="予約する">
</form>
<form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('本当に削除しますか?')">削除</button>
</form>
