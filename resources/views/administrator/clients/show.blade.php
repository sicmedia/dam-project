@extends('welcome')
@section('title','Client')
@section('content')

<div class="row">
  <div class="page-header">
    <h2> {{$client_name}}</h2>
  </div>
</div>

@include('flash::message')
<div class="row">
  {!! Form::open(['route' => 'clients.store', 'class' => 'form-horizontal',
   'enctype' => 'multipart/form-data', 'files' => true, 'method' => 'POST']) !!}
   {{ csrf_field() }}
   <input type="file" name="upload_file"/>
   <input type="submit" name="Upload">
  {!! Form::close() !!}
</div>

@endsection
