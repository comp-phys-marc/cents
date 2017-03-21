<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'facebook_email', 'facebook_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function myCampaigns(){
        return $this->hasMany('App\Models\Campaigns','owner_id');
    }

    public function Campaigns(){
        return $this->belongsToMany('App\Models\Campaigns', 'campaigns_users', 'user_id', 'campaign_id');
    }
    public function Payments(){
        return $this->hasMany('App\Models\Payments','user_id');
    }
}
