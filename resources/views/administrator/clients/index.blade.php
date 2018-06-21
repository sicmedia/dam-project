@extends('welcome')
@section('title','Create Client')
@section('title_nav','CLIENTS')
@section('content')

<div class="container-fluid" style="width: 100%;">

  <table class="table">
    <tbody>
      @foreach($clients as $client)
        <tr>
          <td> <a href="{{ route('clients.show', $client->slug) }}">{{$client->name}}</a> </td>
        </tr>
      @endforeach
    </tbody>
  </table>

</div>

@endsection
