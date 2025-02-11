<h1>一般ユーザー座席予約表</h1>

@if(session('error'))
    <div class="alert alert-success">
        {{ session('error') }}
    </div>
@endif

<p>{{ $movie_id }}</p>
<p>{{ $scheduleId }}</p>
<p>日付：{{ $date }}</p>
<table style="border: 1px solid black; width: 300px;">
    @foreach($sheets->chunk(5) as $chunk)
        <tr>
            @foreach($chunk as $sheet)
             @php
                $sheetReservations = $reservations->get($sheet->id) ?? collect();

                $isFullyReserved = $screens->every(function ($screen) use ($sheetReservations) {
                    return $sheetReservations->contains('screen_id', $screen->id);
                });
             @endphp
                @if($isFullyReserved)
                    <td style="background-color: gray;">
                        {{ $sheet->row }}-{{ $sheet->column }}
                    </td>
                @else
                    <td style="border: 1px solid black;">
                        <a href="{{ route('movies.schedules.reservations.create', ['movie_id' => $movie_id, 'scheduleId' => $scheduleId, 'date' => $date, 'sheetId' => $sheet->id]) }}">{{ $sheet->row }}-{{ $sheet->column }}</a>
                    </td>
                @endif
            @endforeach
        </td>
    @endforeach
</table>
