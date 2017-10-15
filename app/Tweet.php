<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $table ='tweet';

    protected $fillable = ['url'];

    // Tweet can have many users retweet;
    public function Users() {
        return $this->hasMany('App\Users');
    }

}
