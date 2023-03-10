@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="py-4">
    <h1>{{$tag->name}}</h1>
    @if($tag->posts->isNotEmpty())
        <h3>Post associati:</h3>
        <ul>
            @foreach ($tag->posts as $post)
                <li><a href="{{route('admin.posts.show', $post)}}">{{$post->title}}</a></li>
            @endforeach
        </ul>
    @else
        <h3>Nessun post associato</h3>
    @endif
  </div>
</div>
@endsection