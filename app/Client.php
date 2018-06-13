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
    public function files(){
      return $this->hasMany('App\File');
    }
    public function services_clients(){
      return $this->belognsToMany('App\Service_client')->withTimestamps();
    }

    public function category_client(){
      return $this->belongsTo('App\category_client');
    }

    public function status_client(){
      return $this->belongsTo('App\Status_client');
    }
}
