@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="py-4">
    <h1>Crea Post</h1>
    @include('partials.errors')
    <div class="mt-4">
        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Inserisci il titolo" value="{{ old('title') }}">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Contenuto</label>
                <textarea class="form-control" id="content" name="content" rows="10" placeholder="Inserisci il contenuto">{{ old('content') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="cover_image" class="form-label">Immagine</label>
                <div>
                    <img id="output" width="100" class="mb-2"/>
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
                <input type="file" class="form-control" id="cover_image" name="cover_image" value="{{ old('cover_image') }}" onchange="loadFile(event)">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Categoria</label>
                <select class="form-select" name="category_id" id="category_id">
                    <option value="">Senza Categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Crea</button>
        </form>
    </div>
  </div>
</div>
@endsection