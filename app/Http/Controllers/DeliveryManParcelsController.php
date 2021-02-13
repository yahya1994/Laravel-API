<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use App\delivery_man_parcels;
use Illuminate\Http\Request;
use App\Model\User;
use OneSignal;


class DeliveryManParcelsController extends Controller
{
  var $test  = [];
  public function sendRequest(Request $request){
      $client_id =  (int)$request->client_id;
      $delivery_man_id =  (int)$request->delivery_man_id;
      $res=delivery_man_parcels::create([
            'delivery_man_id'=>$request->delivery_man_id,
            'parcel_id'=>$request->parcel_id
        ]);
      $request = delivery_man_parcels::where('delivery_man_id',$delivery_man_id)->get();

      OneSignal::sendNotificationToExternalUser(
          'un livreur intéressé par votre colis ',
          $client_id
      );

      return response()->json(['res'=>$res,'request'=>$request], 200);

    }

public function CancelRequest(Request $request){
    $parcel_id =  $request->parcel_id;
    $delivery_man_id =  $request->delivery_man_id;
    $delivery_man_parcels = delivery_man_parcels::where('parcel_id',$parcel_id)->where('delivery_man_id',$delivery_man_id)->first();
    $delivery_man_parcels->delete();
    $delivery_man_parcel = delivery_man_parcels::where('delivery_man_id',$delivery_man_id)->get();

    return response()->json($delivery_man_parcel, 200);

}
    public function GetRequest(Request $request){
        $parcel_id = (int)$request->parcel_id;
        $delivery_man_id =  $request->delivery_man_id;

        $delivery_man_parcels = delivery_man_parcels::where('delivery_man_id',$delivery_man_id)->get();

        return response()->json(['requests'=>$delivery_man_parcels], 200);

    }




    public function showProfils(Request $request){
        $parcel = $request->parcel;

    $yahya = delivery_man_parcels::where('parcel_id',$parcel)->get();
    foreach ($yahya as $data) {
        $this->test = $data;
        $this->test['delivery_man'] = User::where('id',$data->delivery_man_id)->get();
    }  $yahya ;
    return response()->json( ['profils'=>$yahya], 200);

    }
}
