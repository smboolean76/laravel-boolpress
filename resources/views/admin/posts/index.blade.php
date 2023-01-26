@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="py-4">
    <h1>Lista Posts</h1>
    @include('partials.message')
    <div class="my-4">
      <a href="{{route('admin.posts.create')}}" class="btn btn-primary">Crea Post</a>
    </div>
    <table class="table table-striped table-inverse table-responsive">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Titolo</th>
            <th scope="col">Slug</th>
            <th scope="col">Azioni</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->slug }}</td>
                <td>
                  <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                  <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning"><i class="fa-solid fa-pen"></i></a>
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{$post->id}}">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </td>
            </tr>
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
            @endforeach
        </tbody>
      </table>
  </div>
</div>
@if( session('message') )
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <strong class="me-auto">Notifica</strong>
        <small>{{ \Carbon\Carbon::now()->diffForHumans() }}</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        {{session('message')}}
      </div>
    </div>
  </div>
@endif
@endsection