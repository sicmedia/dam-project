@extends('welcome')
@section('title','Create Client')
@section('content')

<div class="container-fluid" style="width: 100%;">
  <div class="row">
    <div class="page-header">
      <h1>Clients</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="font-size: 1em; background:transparent; padding:1px;">
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Clients</li>
        </ol>
      </nav>
    </div>
  </div>
  <br/>
  <div class="row">

    <div class="col-12">
      {!! Form::open(['route' => 'clients.store',
      'class' => 'form-horizontal', 'method' => 'POST']) !!}
        <div class="form-row">

          <div class="form-group col-md-6">
            {!! Form::label('name', 'Client: *')!!}
            {!! Form::text('name', null, ['class' => 'form-control',
            'maxlength' => '145', 'id' => 'name', 'placeholder' => 'ClientX', 'autocomplete' => 'off', 'required' ]) !!}
          </div>
          <div class="form-group col-md-6">
            {!! Form::label('description', 'Description: ') !!}
            {!! Form::text('description', null, ['class' => 'form-control',
            'placeholder' => 'e.g.', 'autocomplete' => 'off'  ]) !!}
          </div>

        </div>

      {!! Form::close() !!}
    </div>

</div>

@endsection
