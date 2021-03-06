<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'string';
    protected $fillable = ['id', 'email', 'name', 'age', 'birth_date', 'password', 'is_hiworks'];
    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';

    public function picture()
    {
        return $this->hasMany('App\Model\Picture', 'owner_id', 'id');
    }

    public function post()
    {
        return $this->hasMany('App\Model\Post', 'owner_id', 'id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
