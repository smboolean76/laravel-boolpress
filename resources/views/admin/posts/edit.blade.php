@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="py-4">
    <h1>Modifica: {{ $post->title }}</h1>
    @include('partials.errors')
    <div class="mt-4">
        <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Inserisci il titolo" value="{{ old('title', $post->title) }}">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Contenuto</label>
                <textarea class="form-control" id="content" name="content" rows="10" placeholder="Inserisci il contenuto">{{ old('content', $post->content) }}</textarea>
            </div>
            <div class="mb-3">
              <label for="cover_image" class="form-label">Immagine</label>
              <div>
                  <img id="output" width="100" class="mb-2" @if($post->cover_image) src="{{asset("storage/$post->cover_image")}}" @endif/>
                  <script>
                  var loadFile = function(event) {
                      var reader = new FileReader();
                      reader.onload = function(){
                      var output = document.getElementById('output');
                      output.src = reader.result;
                      };
                      reader.readAsDataURL(event.target.files[0]);
                  };
                  </script>
              </div>
              @if($post->cover_image)
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="no_image" name="no_image">
                  <label class="form-check-label" for="no_image">Nessuna immagine</label>
                </div>
              @endif

              <input type="file" class="form-control" id="cover_image" name="cover_image" value="{{ old('cover_image') }}" onchange="loadFile(event)">

              <script>
                const inputCheckbox = document.getElementById('no_image');
                const inputFile = document.getElementById('cover_image');
                inputCheckbox.addEventListener('change', function() {
                  if( inputCheckbox.checked ) {
                    inputFile.disabled = true;
                  } else {
                    inputFile.disabled = false;
                  }
                });
              </script>
          </div>
          <div class="mb-3">
              <label for="category_id" class="form-label">Categoria</label>
              <select class="form-select" name="category_id" id="category_id">
                  <option value="">Senza Categoria</option>
                  @foreach ($categories as $category)
                      <option value="{{$category->id}}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                  @endforeach
              </select>
          </div>
            <button type="submit" class="btn btn-primary">Modifica</button>
        </form>
    </div>
  </div>
</div>
@endsection