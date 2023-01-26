@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="py-4">
    <h1>{{$post->title}}</h1>
    <div class="mt-4">
        {{$post->content}}
    </div>
  </div>
</div>
@endsection