<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;
    protected $table = "files";
    protected $fillable = [
    	'name','description','client_id'
    ];
    protected $dates = ['deleted_at'];
}
