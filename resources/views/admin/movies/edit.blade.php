<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>映画作品編集ページ</title>
</head>
<body>
  <h1>映画作品編集ページ</h1>
  @if ($errors->any())
  <div>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  @if ($movie)
    <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST">
      @csrf
      @method('patch')
      <label for="title">映画タイトル：</label>
      <input type="text" id="title" name="title" required value="{{ $movie->title }}"><br>
      <label for="image_url">画像URL：</label>
      <input type="text" name="image_url" id="image_url" required value="{{ $movie->image_url }}"><br>
      <label for="published_year">公開年：</label>
      <input type="number" name="published_year" id="published_year" required value="{{ $movie->published_year }}"><br>
      <label for="is_showing">公開中：</label>
      <input type="hidden" name="is_showing" value="0">
      <input type="checkbox" name="is_showing" id="is_showing" value="1" @if($movie->is_showing) checked @endif><br>

      <div class="form-group">
          <label for="genre">ジャンル；</label>
          <input type="hidden" name="genre_id" value="{{ $movie->genre_id ?? ''}}">
          <input type="text" name="genre" id="genre" class="form-control" value="{{ $movie->genre->name ?? ''}}" required><br>
      </div>


    {{-- <select name="genre" id="genre">
        @foreach($genres as $genre)
            <option value="{{ old('genre', $movie->genre->name ?? '') }}" @if($movie->genres->contains($genre->id)) selected @endif>{{ $genre->name }}</option>
        @endforeach
    </select><br> --}}
    {{-- <input type="text" name="genre" id="genre" value="{{ old('genre', $movie->genre->name ?? '')}}" required><br> --}}
    <label for="description">概要：</label><br>
    <textarea name="description" id="description" cols="30" rows="10">{{ $movie->description }}</textarea><br>
    <button type="submit" class="btn btn-primary">更新</button>
  </form>
  @else
  <p>指定した値が存在しません</p>
  @endif
</body>
</html>
