@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="py-4">
    <h1>Modifica: {{ $post->title }}</h1>
    @include('partials.errors')
    <div class="mt-4">
        <form action="{{ route('admin.posts.update', $post) }}" method="POST">
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
            <button type="submit" class="btn btn-primary">Modifica</button>
        </form>
    </div>
  </div>
</div>
@endsection