<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>映画一覧</title>
</head>
<body>
  <h1>映画一覧</h1>
  <form action="{{ route('movies.index') }}" method="GET">
    <input type="text" name="keyword" placeholder="キーワードを入力" value="{{ request('keyword') }}">
    <label><input type="radio" name="is_showing" value="all" {{ request('is_showing') == 'all' || request('is_showing') === null ? 'checked' : '' }}>全て</label>
    <label><input type="radio" name="is_showing" value="1" {{ request('is_showing') == '1' ? 'checked' : '' }}>公開中</label>
    <label><input type="radio" name="is_showing" value="0" {{ request('is_showing') == '0' ? 'checked' : '' }}>公開予定</label>
    <button type="submit">検索</button>
  </form>
  {{-- <ul>
    @foreach ($movies as $movie)

      <li>
        <h2>タイトル：{{ $movie->title }}</h2>
        <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}">
        <p>公開年 {{ $movie->published_year }}</p>
        <p>上映中かどうか：{{ $movie->is_showing }}</p>
        <p>概要：{{ $movie->description}}</p>
        <p>登録日時：{{ $movie->crated_at }}</p>
        <p>更新日時；{{ $movie->updated_at }}</p>
      </li>
    @endforeach
  </ul> --}}

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
        <td><a href="{{ route('movies.show', ['id' => $movie->id]) }}">{{ $movie->id }}</a></td>
        <td><a href="{{ route('movies.show', ['id' => $movie->id]) }}">{{ $movie->title }}</a></td>
        <td><a href="{{ route('movies.show', ['id' => $movie->id]) }}"><img src="{{ $movie->image_url }}" alt="{{ $movie->title }}"></a></td>
        {{-- <td>{{ $movie->image_url }}</td> --}}
        <td>{{ $movie->published_year }}</td>
        <td>{{ $movie->is_showing ? '上映中' : '上映予定' }}</td>
        <td>
          @foreach ($movie->genres as $genre)
            {{ $genre->name }}
          @endforeach
        </td>
        <td><a href="{{ route('movies.show', ['id' => $movie->id]) }}">{{ $movie->description }}</a></td>
        <td>{{ $movie->created_at }}</td>
        <td>{{ $movie->updated_at }}</td>
    </tr>
    @endforeach
  </table>

  {{ $movies->appends(request()->query())->links() }}
</body>
</html>
