<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str as generate;

class User extends Authenticatable
{
    use Notifiable;
    public $incrementing = false;
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot(){
        parent::boot();

        static::creating(function($user){
            $user->id = (string) generate::uuid();
        });
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function events()
    {
        return $this->belongsToMany('App\Event');
    }
}
