<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service_client extends Model
{
  use SoftDeletes;
  protected $table    = "services_clients";
  protected $fillable = ['name','description'];
  protected $dates    = ['deleted_at'];
}
