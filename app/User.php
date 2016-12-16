<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\User;
use App\Models\Application;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','admin','manager','user','phone','mobile_phone','username','address','title','log'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAvatar(){
        if(isset($this->avatar))
            return $this->avatar;
        return '/img/default-profile.jpg';
    }

    public function isAdmin(){
        return $this->admin;
    }
    public function isManager(){
        return !$this->admin && $this->manager;
    }
    public function isUser(){
        return !$this->admin && !$this->manager && $this->user;
    }
    public function getRole(){
        if($this->isAdmin()) return "Quản trị hệ thống";
        if($this->isManager()) return "Nhân viên điều hành";
        return null;
    }
    public function checkPermission($request){
        $requestPath = $request->path();
        $user = \Auth::user();
        $path = storage_path() . "/app/permission.json";
        $jsons = json_decode(file_get_contents($path), true); 
        
        foreach ($jsons as $json) {
            # code...
            foreach ($json['actions'] as $action) {
                foreach ($action['urls'] as $url) {
                    /*var_dump($url);
                    var_dump($requestPath);*/
                    if(fnmatch($url,$requestPath)){

                        foreach ($action['roles'] as $role) {
                            if($role == "admin" && $this->isAdmin()){
                                return;
                            }
                            if($role == "manager" && $this->isManager()){
                                return;
                            }
                            if($role == "user" && $this->isUser()){
                                return;
                            }
                        }
                    }
                }
            }
        }        
        abort(401,"You don't have permission to perform this action");

    }
}
