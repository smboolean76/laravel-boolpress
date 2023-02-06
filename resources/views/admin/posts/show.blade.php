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
    @if($post->tags->isNotEmpty())
    <div class="mt-4">
      <h3>Tags</h3>
      @foreach ($post->tags as $tag)
      <span class="badge bg-secondary">{{$tag->name}}</span>
      @endforeach
    </div>
    @endif
    <div class="mt-4">
        <div class="text-center">
          @if ($post->cover_image)
            <img class="w-25" src="{{ asset("storage/$post->cover_image") }}" alt="{{$post->title}}">   
          @endif
        </div>
        {{$post->content}}
    </div>
    <div class="mt-4">
      <h3>Commenti</h3>
      @if($post->comments->isNotEmpty())
        <ul>
          @foreach ($post->comments as $comment)
          <li>
            <h4>{{ $comment->name }}</h4>
            <p>{{ $comment->content }}</p>
            <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Elimina Commento</button>
            </form>
          </li>
          @endforeach
        </ul>
      @else
        <p>Non sono presenti commenti</p>
      @endif
    </div>
    <div class="mt-4">
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