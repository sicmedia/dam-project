@extends('welcome')
@section('title','Create Client')
@section('content')

  <div class="row">
    <div class="page-header">
			<h2> {{$client_name}}</h2>
		</div>
  </div>

  <div class="row">
    {!! Form::open(['route' => 'client.store', 'class' => 'form-horizontal',
     'enctype' => 'multipart/form-data', 'files' => true, 'method' => 'POST']) !!}
     {{ csrf_field() }}
     <input type="file" name="upload_file"/>
     <input type="submit" name="Upload">
    {!! Form::close() !!}
  </div>

@endsection
