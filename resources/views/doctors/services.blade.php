@extends('layouts.app')
@section('content')
@if(Session::has('error'))
<div class="alert alert-danger">
    {{Session::get('error')}}
</div>
@endif

@if(Session::has('success'))
<div class="alert alert-success">{{Session::get('success')}}</div>
@endif
<h1 class='text-center'>Doctors Bage</h1>

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
      </tr>
    </thead>
    <tbody>
        @if(isset($services) && $services -> count() > 0)
        @foreach($services as $service)
        <tr>
            <th scope="row">{{$service -> id}}</th>
            <td>{{$service -> name}}</td>
        </tr>
        @endforeach
        @endif

    </tbody>
  </table>


</br></br></br>

  <div class="container">

<form action="{{route('store.service')}}" method="POST">
    @csrf
    <h1 class='text-center'>
        <span class='text-center'>Add New Service</span>
    </h1>

    <div class="form-group">
        <label for="exampleInputEmail1">select doctor</label>
        <select class="form-control" name="doctor_id">
            @foreach($doctors as $doctor)
            <option value="{{$doctor ->id}}">{{$doctor ->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">select service</label>
        <select class="form-control" name="servicesIds[]" multiple>
            @foreach($allservices as $service)
            <option value="{{$service ->id}}">{{$service ->name}}</option>
            @endforeach
        </select>
        @error('service_id')
        <div class='alert alert-danger'>{{$message}}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-success">store</button>
  </form>
</div>
@endsection
