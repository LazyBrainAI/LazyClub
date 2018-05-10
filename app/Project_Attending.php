<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_Attending extends Model
{
    //
    protected $fillable = ['id', 'team_id', 'user_id', 'role_id'];

    protected $table = 'project_attendings';

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function team(){
        return $this->belongsTo('App\Team');
    }
}
