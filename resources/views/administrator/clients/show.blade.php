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
    <br/>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadFileModal">
      Add a new file
    </button>

    <br/><br/>

    <div class="panel-body">
      <table class="table ">
        <tbody>
          @foreach($files as $file)
            <tr>
              @foreach($file->files_descriptions as $document)
                <td>
                  @if($document->extention == 'pdf')
                    <i class="far fa-file-pdf"></i>
                  @elseif($document->extention == "png" || $document->extention == "jpg")
                    <i class="far fa-file-image"></i>
                  @elseif($document->extention == "doc" || $document->extention == "docx")
                    <i class="far fa-file-word"></i>
                  @endif
                </td>
                <td>{{$document->name}}</td>
                <td>
                  <span class="pull-right text-muted small"><em>{{ $file->created_at }}</em></span>
                </td>
                <td>
                </td>
                <td>
                  <a class="btn btn-primary"
                  href="{{$document->end_point.$document->bucket_name.$document->path.$document->name}}"
                  download="{{$document->name}}"><i class="fas fa-download"></i></a>
									<a class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                  <a class="btn btn-info" onclick="copyText()"><i class="fas fa-share-alt-square"></i></a>
                </td>
              @endforeach
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  @endif

</div>

<br/>

@section('js')
<script type="text/javascript">
  function copyText() {
    var copyText = document.getElementById("link_to_share");
    copyText.select();
    document.execCommand("copy");
    alert("Copied the text: " + copyText.value);
  }
</script>
@endsection


<!-- Modal -->
<div class="modal fade" id="uploadFileModal"
tabindex="-1" role="dialog" aria-labelledby="uploadFile" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      {!! Form::open(['route' => 'clients.store', 'class' => 'form-horizontal',
       'enctype' => 'multipart/form-data', 'files' => true, 'method' => 'POST']) !!}

        <div class="modal-body">
          <p> Route -> dam-project/{{$client_name}}/ </p>

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
