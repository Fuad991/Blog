@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div class="col">
        <div class="jumbotron">
            <h1 class="display-4">Trashed post</h1>
            <a class="btn btn-success" href="{{route('posts')}}">All post</a>
            <a class="btn btn-danger" href="{{route('posts.trashed')}}">Trash <i class="fas fa-trash"></i></a>
        </div>
      </div>
    </div>
    <div class="row">

        @if ($posts->count()>0)
        <div class="col">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Date</th>
                        <th scope="col">User</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Action</th>
                      </tr>
                </thead>
                <tbody>
                    @php
                     $i=1;

                    @endphp

                    @foreach ($posts as $item)
                  <tr>
                    <th scope="row">{{$i++}}</th>
                    <td>{{$item->title}}</td>
                    <td>{{$item->created_at->diffForhumans()}}</td>
                    <td>{{$item->user->name}}</td>
                    <td>
                        <img src="{{URL::asset($item->pic)}}" alt="{{$item->pic}}" class="img_tunbnail" width="100" height="100">
                    </td>
                    <td>
                        <a href="{{route('post.restore',['slug',$item->slug])}}" class="text-success"><i class="fas fa-2x fa-undo"></i></a>&nbsp;
                        <a href="{{route('post.delete',['id'=>$item->id])}}" class="text-danger"><i class="fa-2x fa-solid fa-trash-can"></i></a> &nbsp;
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
          </div>
        @else
        <div class="col">
        <div class="alert alert-danger" role="alert">
            No posts!
          </div>
        </div>
        @endif
    </div>
</div>

  @endsection
