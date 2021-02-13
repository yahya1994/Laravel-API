<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected  $fillable = [
        'latitude','longitude'
,'client_id','delivery_man_id','parcel_id'
];


    public function user() {
        return $this->belongsTo('App\Model\User');
    }
    public function parcel() {
        return $this->belongsTo('App\Model\Parcel');
    }
}
