@extends('layouts.app')
@section('content')

@if(Session::has('success'))
<div class='alert alert-danger'>{{Session::get('success')}}</div>
@endif
<h1 class='text-center'>Hospital Bage</h1>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">adress</th>
            <th scope="col">operations</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($hospitals) && $hospitals -> count() > 0)
        @foreach($hospitals as $hospital)
            <tr>
                <th scope="row">{{$hospital->id}}</th>
                <td><a href="{{route('hospitals.doctors',$hospital->id)}}" class="badge badge-primary">{{$hospital -> name}}</a></td>
                <td>{!!$hospital -> address !!}</td><!-- لعرض الداتا بالتنسيق بتاعهنا اذا دخلت الداتابيز بتنسيق-->
                <td>
                    <a href="{{route('hospitals.doctors',$hospital->id)}}" class="badge badge-primary">show doctors</a>
                    <a href="{{route('delete.hospital',$hospital->id)}}" class="btn  btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
        @endif
    </tbody>
  </table>
@endsection
