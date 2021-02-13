<?php

namespace App\Http\Controllers;
use App\Location;
use Illuminate\Http\Request;
use App\Events\SendLocation;

class LocationController extends Controller
{
    public function sentLocation(Request $request){
       
       $location=Location::create([
           'longitude'=>$request->longitude,
           'latitude'=>$request->latitude,
           'client_id'=>$request->client_id,
           'delivery_man_id'=>$request->delivery_man_id,
           'parcel_id'=>$request->parcel_id
       ]);
       broadcast (new SendLocation($location));
   }

}
