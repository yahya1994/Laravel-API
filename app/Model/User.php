<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    protected  $fillable = [
        'email',
        'name',
        'password',
        'role',
        'cin',
        'phone_number',
        'adresse',
        'identity_card_image',
        'driver_license_image','rapidity','price_km','Accepted'
    ];

    /**
     *User Role
     */
    const ROLE = [
        'DELIVERY_MAN'=>2,
        'CLIENT' => 1,
        'ADMIN' => 0
    ];
    /**
     * deliveryMan registration request status
     */
    const ACCEPTED =[
        'OUI' =>1,
        'NON' =>0
    ];
    public function notification() {
        return $this->hasMany('App\Model\Notification');
    }
    public function location() {
        return $this->hasMany('App\Location');
        }
   
    public function parcel() {
    return $this->hasMany('App\Model\Parcel');
    }

    public function deliveryManInfo() {
    return $this->hasMany('App\Model\DeliveryManInfo');
    }
    public function reclamation() {
        return $this->hasMany('App\Model\Reclamation');
    }

    /**
     * @inheritDoc
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();

    }
    function delivery_man_parcels()
    {
    return $this->hasMany('App\delivery_man_parcels');
    }
    function message() 
    {
    return $this->hasMany('App\Model\Message');
    }
    /**
     * @inheritDoc
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
