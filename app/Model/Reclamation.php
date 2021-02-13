<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Reclamation extends Model
{
    protected  $fillable = [
        'title',
        'description','parcel_id','user_id'

    ];
    public function user() {
        return $this->belongsTo('App\Model\User');
    }
    public function parcel() {
        return $this->belongsTo('App\Model\Parcel');
    }
}
