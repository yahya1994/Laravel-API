<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class delivery_man_parcels extends Model
{
    protected  $fillable = [
        'delivery_man_id','parcel_id'
    ];
    


    public function user() {
        return $this->belongsTo('App\Model\User');
    }
    public function parcel() {
        return $this->belongsTo('App\Model\Parcel');
    }
}
