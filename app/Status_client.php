<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status_client extends Model
{
  use SoftDeletes;
  protected $table    = "status_clients";
  protected $fillable = ['name'];
  protected $dates    = ['deleted_at'];
}
