@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div class="col">
      </div>
    </div>

      <div class="col">
        <div class="card" >
            <img src="{{URL::asset($post->pic)}}" class="card-img-top" alt="{{$post->pic}}">
            <div class="card-body">
              <h5 class="card-title">{{$post->title}}</h5>
              <p class="card-text">{{$post->content}}</p>
              <p>Created at: {{$post->created_at->diffForhumans()}}</p>
              <p>Updated at: {{$post->updated_at->diffForhumans()}}</p>

                @foreach ($tags as $item)
                <label for="">{{$item->tag}}</label>
                @endforeach

              <a class="btn btn-success" href="{{route('posts')}}">All post</a>
            </div>
          </div>
      </div>
    </div>
  </div>
  @endsection
