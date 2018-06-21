<?php

namespace App\Http\Controllers;

use DB;
use App\Category_client;
use App\Status_client;

use App\File;
use App\Client;
use App\File_description;

use Response;

use Illuminate\Http\Request;

use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;

use Caffeinated\Flash\Facades\Flash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;

class ClientController extends Controller {
  public function index(){
    $clients = Client::orderBy('id','DESC')->paginate(10);
    $clients->each(function($clients){
      $clients->category_client;
      $clients->status_client;
    });
    return view('administrator.clients.index')->with('clients',$clients);
  }
  public function create(){}

  public function store(Request $request){

    $client = DB::table("clients")->where('slug',$request->client_name);

    $client_name = $request->client_name;

    if($client->value('id') == "" || $client->value('id') == null){
        return view('welcome');
    }
    $rules = [
      'upload_file'           => 'required'
    ];
    $messages = [
      'upload_file.required'  => 'Tienes que ingresar un archivo.'
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
    }

    if($request->file('upload_file')) {

        $file = $request->file('upload_file');

        $size         = \File::size($file);
        $name         = $request->client_name.'_'.$client->value('id').'-'.time().'.'.$file->getClientOriginalExtension();
        $path         = 'dam-project/'.$client_name.'/';
        $end_point    = "https://nyc3.digitaloceanspaces.com/";
        $bucket_name  = "sicmedia-storage/";

        //Storage::disk('spaces')->putFile('dam-project/'.$client_name, $name, 'public');

        $document = $path.$name;

        Storage::disk('spaces')->putFileAs($path, $file, $name);
        Storage::disk('spaces')->setVisibility($document, 'public'); // Set the visibility to public.

        /*
        $res = Storage::disk('spaces')->put($document, '¡File added!');
        Storage::disk('spaces')->setVisibility($document, 'public'); // Set the visibility to public.
        $url = Storage::disk('spaces')->url($document);
        */

        //return \Response::json(['success' => true, 'response' => $url]);

        $extension = \File::extension($end_point.$bucket_name.$name);

        $file = new File();
        $file->name         = "New file -> " . $client->value('name');
        $file->description  = "Added -> " . time();
        $file->client_id    = $client->value('id');
        $file->save();

        $file_description = new File_description();
        $file_description->name         = $name;
        $file_description->path         = $path;
        $file_description->size         = $size;
        $file_description->extention    = $extension;
        $file_description->bucket_name  = $bucket_name;
        $file_description->end_point    = $end_point;
        $file_description->file()->associate($file);
        $file_description->save();

        Flash::success('¡Saved successfully!');
        return redirect()->route('clients.index');

    }else{
        return redirect()->back()->withErrors('¡Error! File not found.')->withInput($request->all());
    }

  }

  public function show($client_name){
    $client   = Client::where('slug','=',$client_name);
    $files    = File::where('client_id','=',$client->value('id'))
                ->orderBy('id','DESC')->paginate(10);

    $files->each(function($files){
      $files->client;
      $files->files_descriptions;
    });

    return view('administrator.clients.show')
              ->with('client',strtoupper($client->value('name')))
              ->with('client_name',$client->value('slug'))
              ->with('files',$files);
  }

  public function edit($id){}
  public function update(Request $request, $id){}
  public function destroy($id){}

}
