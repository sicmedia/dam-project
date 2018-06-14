<?php

namespace App\Http\Controllers;

use DB;
use App\Category_client;
use App\Status_client;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller {
  public function index(){
  }
  public function create(){}

  public function store(Request $request){

    $fileName = time().'.txt'; // generate unique name.
    $res = Storage::disk('do_spaces')->put($fileName, 'Hi…');
    Storage::disk('do_spaces')->setVisibility($fileName, 'public'); // Set the visibility to public.
    $url = Storage::disk('do_spaces')->url($fileName);
    return Response::json(['success' => true, 'response' => $url]);

  }

  public function show($client_name){
    $clients = Client::where('slug','=',$client_name)->orderBy('id','DESC')->paginate(10);
    return view('administrator.clients.index')
            	->with('clients',$clients)
              ->with('client_name',$client_name);
  }
  public function edit($id){}
  public function update(Request $request, $id){}
  public function destroy($id){}

}
