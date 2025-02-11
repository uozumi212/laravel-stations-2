<h1>管理者座席予約フォーム</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form method="POST" action="{{ route('admin.reservations') }}">
    @csrf
        <select name="movie_id" id="">
           @foreach($movies as $movie)
            <option value="{{ $movie->id }}">{{ $movie->title }}"></option>
            @endforeach
        </select><br>
        <select name="schedule_id" id="">
            @foreach($schedules as $schedule)
                <option value="{{ $schedule->id }}">{{ $schedule->start_time }}</option>
                      <option value="{{ $schedule->id }}">{{ $schedule->end_time }}</option>
            @endforeach
        </select><br>
        <select name="sheet_id" id="">
            @foreach($sheets as $sheet)
            <option value="{{ $sheet->id }}">{{ $sheet->row }}-{{ $sheet->column  }}</option>
            @endforeach
        </select><br>

    <input type="date" name="date" value="{{ now()->format('Y-m-d') }}"><br>
    <label for="name">予約者氏名:</label>
    <input type="text" id="name" name="name"><br>
    <label for="email">予約者メールアドレス:</label>
    <input type="email" id="email" name="email"><br>
    <input type="submit" value="予約する">
</form>
