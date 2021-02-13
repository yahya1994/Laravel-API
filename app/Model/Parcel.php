<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    protected  $fillable = [
        'description',
        'date','Receiver_name','cost',
        'status','Receiver_num_Tel',
         'Distance',
        'starting_adresse','starting_longitude',
        'destination_adresse','starting_latitude'
        ,'destination_latitude'
        ,'user_id','delivery_man_id','destination_longitude'
    ];
    /**
     * Parcel Const
     */
    const STATUS_WAITING = 0;
    const STATUS_PICK_UP = 3;
    const STATUS_IN_PROGRESS = 1;
    const STATUS_DELIVERED = 2;  

    public function reclamation() {
        return $this->hasMany('App\Model\Reclamation');
    }
    public function message() {
        return $this->hasMany('App\Model\Message');
    }
    public function notification() {
        return $this->hasMany('App\Model\Notification');
    }
    public function location() {
        return $this->hasMany('App\Location');
        }
    public function user() {
        return $this->belongsTo('App\Model\User');
    }
}

