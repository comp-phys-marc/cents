<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaigns extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "campaigns";

    public function Owner(){
        return $this->belongsTo('App\User', 'owner_id');
    }

    public function Users(){
        return $this->belongsToMany('App\User', 'campaigns_users', 'campaign_id', 'user_id');
    }
}
