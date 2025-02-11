<h1>一般ユーザー座席予約表</h1>

<p>{{ $movie_id }}</p>
<p>{{  }}</p>

@foreach($sheets as $sheet)
    <p>{{ $sheet->name }}</p>
@endforeach
