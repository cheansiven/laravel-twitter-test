<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    public $timestamps = false;

    protected $table ='users';
    protected $fillable =['name', 'follower','tweet_id'];

    public function tweet() {
        return $this->belongsTo('App\Tweet','tweet_id','id');
    }
}
