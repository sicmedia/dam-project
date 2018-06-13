<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Client extends Model
{
    use Sluggable;
    use SoftDeletes;
    protected $table = "clients";
    protected $fillable = [
    'name','description','category_client_id',
    'status_client_id'];
    protected $dates = ['deleted_at'];

    public function sluggable(){
      return [
        'slug' => ['source' => 'title']
      ]
    }
}
