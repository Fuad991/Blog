@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div class="col">
        <div class="jumbotron">
            <h1 class="display-4">create post</h1>
            <a class="btn btn-success" href="{{route('posts')}}">All post</a>
          </div>
      </div>
    </div>

    @if (count($errors)>0)<!-- هاي عشان اذا في ايرور نعرضه-->
        <ul>
            @foreach ($errors->all() as $item)
                <li>
                    {{$item}}
                </li>
            @endforeach
        </ul>
    @endif

      <div class="col">
        <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data"> <!-- حطينا ال انكتايب عشان نسمح بتحميل الصور-->
           @csrf
            <div class="form-group">
              <label for="exampleFormControlInput1">Title</label>
              <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                @foreach ($tags as $item)
                <input type="checkbox" name="tag[]"
                value="{{$item->id}}">
                <label for="">{{$item->tag}}</label>
                @endforeach
              </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Content</label>
              <textarea class="form-control" name="content" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Picture</label>
                <input type="file" name="pic" class="form-control">
              </div>
              <br>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">save</button>
            </div>
          </form>
      </div>
    </div>
  </div>
  @endsection
