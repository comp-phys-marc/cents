<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "payments";

    public function Users(){
        return $this->belongsTo('App\User','user_id');
    }

    public function Campaign(){
        return $this->belongsTo('App\Models\Campaigns','campaign_id');
    }
}
