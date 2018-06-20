@extends('welcome')
@section('title','Client')
@section('title_nav', $client)
@section('content')

<br/>

<div class="container">

  <div class="row">
    <div class="col-lg-12"><h4>¡Welcome! This is your data space in SicMedia.</h4></div>
  </div>

  @if(count($errors) > 0)
  	<div class="alert alert-danger" role="alert">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  		<ul>
  			@foreach($errors->all() as $error)
  				<li>{{$error}}</li>
  			@endforeach
  		</ul>
  	</div>
  @endif

  @include('flash::message')

  @if(count($files) == 0)
    <p>Looks like you don't have any file.</p>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadFileModal">
      Add your first file
    </button>
  @else
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadFileModal">
      Add a new file
    </button>
  @endif

</div>

<br/>


<!-- Modal -->
<div class="modal fade" id="uploadFileModal"
tabindex="-1" role="dialog" aria-labelledby="uploadFile" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      {!! Form::open(['route' => 'clients.store', 'class' => 'form-horizontal',
       'enctype' => 'multipart/form-data', 'files' => true, 'method' => 'POST']) !!}

        <div class="modal-body">
          <input type="hidden" name="client_name" value="{{$client_name}}"/>
          <div class="form-group">
           <input type="file" name="upload_file" class="form-control-file" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="Upload" class="btn btn-success">upload file</button>
        </div>

      {!! Form::close() !!}

    </div>
  </div>
</div>

@endsection
