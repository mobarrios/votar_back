<?php

namespace App\Entities\Configs;


class Permission extends \Bican\Roles\Models\Permission
{
    public function getPermissonsByRoles($role){

        return $this->Roles->where('slug',$role)->count();
    }

//    //Polymorph
//    public function logs()
//    {
//        return $this->morphMany('App\Entities\Configs\Logs','logeable');
//    }

}