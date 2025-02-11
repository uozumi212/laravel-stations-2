<h1>座席予約フォーム</h1>

<p>映画ID: {{ $movieId }}</p>
<p>スケジュールID: {{ $scheduleId }}</p>
<p>座席ID: {{ $sheetId }}</p>
<p>日付: {{ $date }}</p>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form method="POST" action="{{ route('reservations.store') }}">
    @csrf
    <input type="hidden" name="movie_id" value="{{ $movieId }}">
    <input type="hidden" name="schedule_id" value="{{ $scheduleId }}">
    <input type="hidden" name="sheet_id" value="{{ $sheetId }}">
    <input type="hidden" name="date" value="{{ $date }}">
    <label for="name">予約者氏名:</label>
    <input type="text" id="name" name="name"><br><br>
    <label for="email">予約者メールアドレス:</label>
    <input type="email" id="email" name="email"><br><br>
    <input type="submit" value="予約する">
</form>
