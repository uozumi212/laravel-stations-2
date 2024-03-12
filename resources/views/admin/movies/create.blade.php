<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>映画作品投稿ページ</title>
</head>
<body>
  <h1>映画投稿ページ</h1>
  @if ($errors->any())
  <div>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <form action="{{ route('admin.movies.store')}}" method="POST">
    @csrf
    <label for="title">映画タイトル：</label>
    <input type="text" id="title" name="title" value="title" required><br>
    <label for="image_url">画像URL：</label>
    <input type="text" name="image_url" id="image_url" value="https://github.com/uozumi212/laravel-stations-2" required><br>
    <label for="published_year">公開年：</label>
    <input type="number" name="published_year" id="published_year" value="2008" required><br>
    <label for="is_showing">公開中かどうか：</label>
    <input type="checkbox" name="is_showing" id="is_showing" value="1"><br>
    {{-- <input type="checkbox" name="is_showing" id="is_showing" value="1" @if(old('is_showing', false)) checked @endif><br> --}}
    <label for="genre">ジャンル；</label>
    <input type="text" name="genre" id="genre" value="ジャンル" class="form-control" required><br>
    {{-- <select name="genre" id="genre">

      @foreach($genres as $genre)
        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
      @endforeach

    </select><br> --}}

    <label for="description">概要：</label><br>
    <textarea name="description" id="description" value="tttt" cols="30" rows="10"></textarea><br>
    <button type="submit" class="btn btn-primary">登録</button>
  </form>
</body>
</html>
