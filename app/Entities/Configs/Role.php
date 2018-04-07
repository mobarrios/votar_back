<?php

namespace App\Entities\Configs;


class Role extends \Bican\Roles\Models\Role
{
    public function getPermissionsIdAttribute()
    {
        return $this->Permissions->lists('id')->toArray();
    }

//    //Polymorph
//    public function logs()
//    {
//        return $this->morphMany('App\Entities\Configs\Logs','logeable');
//    }

}