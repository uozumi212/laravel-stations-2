<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>管理者映画一覧</title>
</head>
<body>
  <h1>管理者映画一覧</h1>
      <table border="1">
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Image URL</th>
          <th>Published Year</th>
          <th>Is Showing</th>
          <th>Genre</th>
          <th>Description</th>
          <th>Created At</th>
          <th>Updated At</th>
        </tr>
        @foreach ($movies as $movie)
        <tr>
          <td>{{ $movie->id }}</td>
          <td><a href="{{ route('admin.movies.show', $movie) }}">{{ $movie->title }}</a></td>
          <td><a href="{{ route('admin.movies.show', $movie) }}"><img src="{{ $movie->image_url }}" alt="{{ $movie->title }}"></a></td>
          <td>{{ $movie->published_year }}</td>
          <td>@if ($movie->is_showing)
              上映中
            @else
              上映予定
            @endif
          </td>
          <td>
            {{-- @foreach ($movie->genres as $genre)
              {{ $genre->name }}
            @endforeach --}}
            {{$movie->genre->name}}
            {{-- @foreach ($movie->genres ?? [] as $genre)
              {{ $genre->name }}
            @endforeach --}}
          </td>

          <td>{{ $movie->description}}</td>
          <td>{{ $movie->created_at }}</td>
          <td>{{ $movie->updated_at }}</td>
       <td>
        {{-- <a href="{{ route('admin.movies.edit', $movie->id) }}"> --}}
          <a href="{{ route('admin.movies.edit', $movie) }}">
          <button>編集</button>
        </a>
        <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" onclick="return confirm('本当に削除しますか?')">削除</button>
        </form>
       </td>
      </tr>
        @endforeach
      </table>

</body>
</html>
