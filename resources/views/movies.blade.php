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
  <ul>
    @foreach ($movies as $movie)

      <li>
        <h2>タイトル：{{ $movie->title }}</h2>
        <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}">
      </li>
    @endforeach
  </ul>
</body>
</html>
