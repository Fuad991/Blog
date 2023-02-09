@extends('layouts.app')

@section('content')

@php
$genderArray=['Male','Female']  //هاي عشان الابديت للجيندر
$provinceArray=['Amman','zarqa','irbid','aqba']
@endphp

<div class="container" style="padding-top:8%">

@if (count($errors)>0)<!--هاي بتطلعلي لاليرور-->
@foreach ($errors->all() as $item)
<div class="alert alert-danger" role="alert">
   {{$item}}
  </div>
@endforeach

@endif

<form method="post" action="{{route('profile.update')}}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Name</label>
        <input type="text" name="name" class="form-control"  value="{!!$user->name !!}">
      </div>
    <div class="form-group">
      <label for="exampleFormControlSelect1">gender</label>
      <select class="form-control" name="gender">
        @foreach ($genderArray as $item)
         <option value="{{$item}}" {{ ($user->profile->gender == $item)?'selected':' '}}>{{$item}}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">province</label>
        <select class="form-control" name="province">
          @foreach ($provinceArray as $item)
           <option value="{{$item}}" {{ ($user->profile->gender == $item)?'selected':' '}}>{{$item}}</option>
          @endforeach
        </select>
      </div>

    <div class="form-group">
      <label for="exampleFormControlSelect2">Bio</label>
      <textarea name="bio" class="form-control" rows="3">
        {!! $user->profile->bio !!}
      </textarea>
      </select>
    </div>
    <div class="form-group">
      <label for="exampleFormControlTextarea1">CV</label>
      <textarea name="bio" class="form-control" rows="3">
        {!! $user->profile->cv !!}
      </textarea>
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea1">password</label>
        <input type="password" name="password" class="form-control" >
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">confirm password</label>
        <input type="password" name="c-password" class="form-control" >
      </div>

    <div class="form-group">
        <button class="btn btn-success" type="submit">update</button>
    </div>

  </form>
</div>
@endsection
