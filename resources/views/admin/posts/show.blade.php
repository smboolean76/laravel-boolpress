@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="py-4">
    <h1>{{$post->title}}</h1>
    <h3>
      @if($post->category)
        Categoria: <a href="{{route('admin.categories.show', $post->category)}}">{{$post->category->name}}</a>
      @else 
        Nessuna Categoria
      @endif
    </h3>
    <div class="mt-4">
        <div class="text-center">
          @if ($post->cover_image)
            <img class="w-25" src="{{ asset("storage/$post->cover_image") }}" alt="{{$post->title}}">   
          @endif
        </div>
        {{$post->content}}
    </div>
    <div>
      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{$post->id}}">
        <i class="fa-solid fa-trash"></i> Elimina Post
      </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-{{$post->id}}" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Conferma</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Sei sicuro di eliminare il post "{{$post->title}}"?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline-block">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-primary">Si</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection