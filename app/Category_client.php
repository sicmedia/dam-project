<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category_client extends Model
{
    use SoftDeletes;
    protected $table    = "category_clients";
    protected $fillable = ['name'];
    protected $dates    = ['deleted_at'];
}
