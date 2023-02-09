@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div class="col">
        <div class="jumbotron">
            <h1 class="display-4">All tags</h1>
            <a class="btn btn-success" href="{{route('tag.create')}}">Create tag</a>
        </div>
      </div>
    </div>
    <div class="row">

        @if ($tags->count()>0)<!--هاذ عشان يتاكد انه في لهاذ اليوزر تاجات -->

        <div class="col">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                      </tr>
                </thead>
                <tbody>
                    @php
                     $i=1;

                    @endphp

                    @foreach ($tags as $item)
                  <tr>
                    <th scope="row">{{$i++}}</th>
                    <td>{{$item->tag}}</td>
                    <td>
                        <a href="{{route('tag.edit',['id',$item->id])}}"><i class="fa-2x fa-solid fa-pen-to-square"></i></a> &nbsp; <!--هاي عشان ربط صفحة الايديت -->
                        <a href="{{route('tag.destroy',['id'=>$item->id])}}" class="text-danger"><i class="fa-2x fa-solid fa-trash-can"></i></a> &nbsp; <!--&nbsp; هاذ الفنكشن عشان يعطي مساحة بينهم-->
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
          </div>
        @else
        <div class="col">
        <div class="alert alert-danger" role="alert">
            No tags!
          </div>
        </div>
        @endif
    </div>
</div>

  @endsection
