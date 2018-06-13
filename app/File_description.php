<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File_description extends Model
{
    use SoftDeletes;
	  protected $table = "files_descriptions";
    protected $fillable = ['name','path',
    'size','extention','file_id'];
    protected $dates = ['deleted_at'];
}