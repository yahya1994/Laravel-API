<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model{
protected  $fillable = [
    'message','parcel_id',
    'user_id' 
];
public function user() {
    return $this->belongsTo('App\User');
}
public function parcel() {
    return $this->belongsTo('App\Parcel');
}
}
