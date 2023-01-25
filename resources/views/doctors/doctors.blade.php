@extends('layouts.app')
@section('content')
<h1 class='text-center'>Doctors Bage</h1>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">title</th>
        <th scope="col">Operations</th>
      </tr>
    </thead>
    <tbody>
    @if(isset($doctors) && $doctors -> count() > 0)
    @foreach($doctors as $doctor)
      <tr>
        <th scope="row">{{$doctor -> id}}</th>
        <td>{{$doctor -> name}}</td>
        <td>{{$doctor -> title}}</td>
        <td>
            <a href="{{route('show.services',$doctor -> id)}}" class="badge badge-primary">show Services</a>
        </td>
      </tr>
    @endforeach
    @endif
    </tbody>
  </table>
@endsection
