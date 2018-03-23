<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    //

    protected $guarded=[];

    public function studies(){
        return $this->hasMany('App\Study');
    }


    public function employments(){
        return $this->hasMany('App\Employment');
    }
}
