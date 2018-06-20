<?php

namespace App\Http\Controllers;

use DB;
use App\Category_client;
use App\Status_client;

use App\File;
use App\Client;

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
    return view('administrator.clients.index');
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
        $name = $request->client_name.'_' . $client->value('id') . '-' .
        $size = \File::size($file);

         time() . '.' . $file->getClientOriginalExtension();
        Storage::disk('spaces')->putFile('dam-project/'.$client_name, $name, 'public');

        $file = new File();
        $file->name         = "New file -> " . $client->value('name');
        $file->description  = "Added -> " . time();
        $file->client_id    = $client->value('id');
        $file->save();


        $file_description = new File_description();
        $file_description->name       = $name;
        $file_description->path       = 'dam-project/'.$client_name.'/';
        $file_description->size       = $size;
        $file_description->extention  = '-';
        $file_description->file()->associate($file);
        $file_description->save();

        Flash::success('¡Saved successfully!');
        return redirect()->route('clients.show');

    }else{
        return redirect()->back()->withErrors('¡Error! File not found.')->withInput($request->all());
    }

  }

  public function show($client_name){
    $client   = Client::where('slug','=',$client_name);
    $files    = File::all();
    return view('administrator.clients.show')
              ->with('client',strtoupper($client->value('name')))
              ->with('client_name',$client->value('slug'))
              ->with('files',$files);
  }

  public function edit($id){}
  public function update(Request $request, $id){}
  public function destroy($id){}

}
