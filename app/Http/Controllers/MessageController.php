<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColisFormRequest;
use App\Model\Parcel;
use App\Repositories\ColisRepo\ColisRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Model\Message;
use OneSignal;
use App\Events\Chat;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use JWTAuth;

class MessageController extends Controller
{

  var $test  = [];

   public function sentMessage(Request $request){
        $user='yahya';

       $message=Message::create([
           'user_id'=>$request->user_id,'content'=>$request->Content,'parcel_id'=>$request->parcel_id,

       ]);
       if ($request->role  ==1 ){
       OneSignal::sendNotificationToExternalUser(
        'vous avez un nouveau message',
        Parcel::find($request->parcel_id)->delivery_man_id
    );
  }else {
    OneSignal::sendNotificationToExternalUser(
      'vous avez un nouveau message',
      User::find($request->user_id)->id
  );
  }
       broadcast (new Chat($user,$message));

   }

   public function fetchMessages(Request $request)
   { if ($request->id != ''){
     return Message::where('parcel_id',$request->id)->get();
    }else {
      return Message::get();
    }
   }
    public function discusion () {
      $conversation = Message::select('parcel_id','user_id')->groupByRaw('parcel_id,user_id')->orderBy('parcel_id','desc')->get();
      foreach ($conversation as $data) {
          $this->test = $data;
          $this->test['user'] = User::where('id',$data->user_id)->get();
          $this->test['deliveryMan'] = Parcel::where('id',$data->parcel_id)->get();


      }  $conversation ;


            return response()->json(
              [
                  'rec' => $conversation
              ],
              200
          );

}

}

