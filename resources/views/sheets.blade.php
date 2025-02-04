<h2>座席表</h2>
<table style="border: 1px solid black">
    <tr style="border: 1px solid black">
        <th style="border: 1px solid black">スクリーン</th>
    </tr>
    @foreach ($sheets as $sheet)
        <tr style="border: 1px solid black">
            <td style="border: 1px solid black">{{ $sheet->row }}-{{ $sheet->column }}</td>
        </tr>
    @endforeach
</table>
