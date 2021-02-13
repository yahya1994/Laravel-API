<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected  $fillable = [
        'title',
        'content',
        'user_id',  'parcel_id'
            ];

    public function user() {
        return $this->belongsTo('App\Model\User');
    }
    public function parcel() {
        return $this->belongsTo('App\Model\Parcel');
    }






}
