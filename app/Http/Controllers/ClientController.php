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
  }
  public function create(){}

  public function store(Request $request){

    /*
    $fileName = time().'.txt'; // generate unique name.
    $res = Storage::disk('do_spaces')->put($fileName, 'Hi…');
    Storage::disk('do_spaces')->setVisibility($fileName, 'public'); // Set the visibility to public.
    $url = Storage::disk('do_spaces')->url($fileName);
    return Response::json(['success' => true, 'response' => $url]);


    $client = new S3Client([
        'credentials' => [
            'key'    => 'UQGPQMJKAOHE5PY2HBY5',
            'secret' => 'aOWa6fR52cnstu/17eZuyPZcOHQhyzzEjv8ZnoWrbtc'
        ],
        'region' => 'ny3',
        'version' => 'latest',
        'endpoint' => 'https://nyc3.digitaloceanspaces.com',
    ]);

    $fileName = time().'.txt'; // generate unique name.
    $adapter = new AwsS3Adapter($client, 'sicmedia-storage');
    $filesystem = new Filesystem($adapter);*/

    Storage::disk('spaces')->putFile('dam-project/office-gurus', request()->upload_file, 'public');


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
