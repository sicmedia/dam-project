<?php

namespace App\Http\Controllers;

use DB;
use App\Category_client;
use App\Status_client;
use App\Client;
use Illuminate\Http\Request;

use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;

use Illuminate\Support\Facades\Storage;

class ClientController extends Controller {
  public function index(){
    return view('administrator.clients.index');
  }
  public function create(){}

  public function store(Request $request){
    Storage::disk('spaces')->putFile('dam-project/office-gurus',
     request()->upload_file, 'public');
  }

  public function show($client_name){
    $clients = Client::where('slug','=',$client_name)->orderBy('id','DESC')->paginate(10);
    return view('administrator.clients.show')
            	->with('clients',$clients)
              ->with('client_name',$client_name);
  }
  public function edit($id){}
  public function update(Request $request, $id){}
  public function destroy($id){}

}
