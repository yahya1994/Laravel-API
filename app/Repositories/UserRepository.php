<?php


namespace App\Repositories;

use Config;
use App\Model\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignUpResponse;
use Illuminate\Http\Request;

class UserRepository
{

 /**
     * @return \Illuminate\Support\Collection
     */
    public static function getCLientStats()
    {
            /* return $user = DB::table('users')
            ->select(DB::raw('count(*) as users_count, MONTH(created_at) month'))
            ->groupby('month')
            ->where('role', User::ROLE['CLIENT'])
            ->get();*/
        $user["Jan"] =User::where('role', User::ROLE['CLIENT'])
        ->where('Accepted', User::ACCEPTED['OUI'])
        ->where('created_at' ,'>=','2020-01-01')->where('created_at' ,'<=','2020-01-31')->count();
        $user["Fev"] =User::where('role', User::ROLE['CLIENT'])
        ->where('created_at' ,'>=','2020-02-01')->where('created_at' ,'<=','2020-02-31')->count();
        $user["Mar"] =User::where('role', User::ROLE['CLIENT'])
        ->where('created_at' ,'>=','2020-03-01')->where('created_at' ,'<=','2020-03-31')->count();
        $user["avril"] =User::where('role', User::ROLE['CLIENT'])
        ->where('created_at' ,'>=','2020-04-01')->where('created_at' ,'<=','2020-07-31')->count();
        $user["mai"] =User::where('role', User::ROLE['CLIENT'])
        ->where('created_at' ,'>=','2020-05-01')->where('created_at' ,'<=','2020-08-31')->count();
        $user["juin"] =User::where('role', User::ROLE['CLIENT'])
        ->where('created_at' ,'>=','2020-06-01')->where('created_at' ,'<=','2020-09-31')->count();
        $user["Jul"] =User::where('role', User::ROLE['CLIENT'])
        ->where('created_at' ,'>=','2020-07-01')->where('created_at' ,'<=','2020-10-31')->count();
        $user["Aug"] =User::where('role', User::ROLE['CLIENT'])
        ->where('created_at' ,'>=','2020-08-01')->where('created_at' ,'<=','2020-11-31')->count();
        $user["Sep"] =User::where('role', User::ROLE['CLIENT'])
        ->where('created_at' ,'>=','2020-09-01')->where('created_at' ,'<=','2020-12-31')->count();
        $user["Oct"] =User::where('role', User::ROLE['CLIENT'])
        ->where('created_at' ,'>=','2020-10-01')->where('created_at' ,'<=','2020-12-31')->count();
        $user["Nov"] =User::where('role', User::ROLE['CLIENT'])
        ->where('created_at' ,'>=','2020-11-01')->where('created_at' ,'<=','2020-12-31')->count();
        $user["Dec"] =User::where('role', User::ROLE['CLIENT'])
        ->where('created_at' ,'>=','2020-12-01')->where('created_at' ,'<=','2020-12-31')->count();



            return  $user ;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public static function getDeliveryManStats()
    {
        $user["Jan"] =User::where('role', User::ROLE['DELIVERY_MAN'])
        ->where('Accepted', User::ACCEPTED['OUI'])
        ->where('created_at' ,'>=','2020-01-01')->where('created_at' ,'<=','2020-01-31')->count();
        $user["Fev"] =User::where('role', User::ROLE['DELIVERY_MAN'])
        ->where('created_at' ,'>=','2020-02-01')->where('created_at' ,'<=','2020-02-31')->count();
        $user["Mar"] =User::where('role', User::ROLE['DELIVERY_MAN'])
        ->where('created_at' ,'>=','2020-03-01')->where('created_at' ,'<=','2020-03-31')->count();
        $user["avril"] =User::where('role', User::ROLE['DELIVERY_MAN'])
        ->where('created_at' ,'>=','2020-04-01')->where('created_at' ,'<=','2020-07-31')->count();
        $user["mai"] =User::where('role', User::ROLE['DELIVERY_MAN'])
        ->where('created_at' ,'>=','2020-05-01')->where('created_at' ,'<=','2020-08-31')->count();
        $user["juin"] =User::where('role', User::ROLE['DELIVERY_MAN'])
        ->where('created_at' ,'>=','2020-06-01')->where('created_at' ,'<=','2020-09-31')->count();
        $user["Jul"] =User::where('role', User::ROLE['DELIVERY_MAN'])
        ->where('created_at' ,'>=','2020-07-01')->where('created_at' ,'<=','2020-10-31')->count();
        $user["Aug"] =User::where('role', User::ROLE['DELIVERY_MAN'])
        ->where('created_at' ,'>=','2020-08-01')->where('created_at' ,'<=','2020-11-31')->count();
        $user["Sep"] =User::where('role', User::ROLE['DELIVERY_MAN'])
        ->where('created_at' ,'>=','2020-09-01')->where('created_at' ,'<=','2020-12-31')->count();
        $user["Oct"] =User::where('role', User::ROLE['DELIVERY_MAN'])
        ->where('created_at' ,'>=','2020-10-01')->where('created_at' ,'<=','2020-12-31')->count();
        $user["Nov"] =User::where('role', User::ROLE['DELIVERY_MAN'])
        ->where('created_at' ,'>=','2020-11-01')->where('created_at' ,'<=','2020-12-31')->count();
        $user["Dec"] =User::where('role', User::ROLE['DELIVERY_MAN'])
        ->where('created_at' ,'>=','2020-12-01')->where('created_at' ,'<=','2020-12-31')->count();

        return  $user ;
    }


    /**
     * @param $id
     * @return mixed
     */
    public static function Accepted($id)
    {
       $user = User::where('id', $id)->update(['Accepted' => User::ACCEPTED['OUI']]);
        $UserEmail = User::where('id', $id)->select("id","name", "email")->first();
        Mail::to($UserEmail['email'] )->send(new SignUpResponse());

        return $user;
     }






    /**
     * @return mixed
     */
    public static function getClientNumber()
    {
        $user = User::where('role', User::ROLE['CLIENT'])->count();
        return $user;

    }

    /**
     * @return mixed
     */
    public static function getDeliveryManNumber()
    {
        $user = User::where('role', User::ROLE['DELIVERY_MAN'])->count();
        return $user;
    }

    /**
     * @return mixed
     */
    public static function getDeliveryMan($name)
    {
        if  ( $name !='' ){
        $user = User::where('role', User::ROLE['DELIVERY_MAN'])->where('Accepted', User::ACCEPTED['OUI'])
        ->where('name','LIKE','%'.$name.'%')
        ->paginate(5)   ;
    }
        else {
            $user = User::where('role', User::ROLE['DELIVERY_MAN'])->where('Accepted', User::ACCEPTED['OUI'])
            ->paginate(5) ;
        }
        return $user;
    }
    /**
     * @return mixed
     */
    public static function getDeliveryManInAccepted($name){
        if  ( $name !='' ){
      $user = User::where('role', User::ROLE['DELIVERY_MAN'])->where('Accepted', User::ACCEPTED['NON'])
      ->where('name','LIKE','%'.$name.'%')
      ->paginate(5)  ;
  }
      else { $user = User::where('Accepted', User::ACCEPTED['NON'])
      ->where('role', User::ROLE['DELIVERY_MAN'])
      ->paginate(5) ;
  }
  return $user;
  }


/**
   * @return mixed
   */
  public static function getClient($name)
  {
      if  ( $name !='' ){
      $user = User::where('role', User::ROLE['CLIENT'])->where('name','LIKE','%'.$name.'%')
        ->orderBy('updated_at','desc')
      ->paginate(5)  ;
      }
      else {
      $user = User::where('role', User::ROLE['CLIENT']) ->orderBy('updated_at','desc')->paginate(5) ;
      }
      return $user;
  }



    /**
     * @param $id
     * @return mixed
     */
    public static function delete($id)
    {
        $user = User::where('id', $id);
        return $user;
    }

    public static function show($id)
    {
        $user = User::where('id', $id)->get();
        return $user;
    }

    /**
     * @param $request
     * @return User
     */
    public static function create($request)
    {
        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->cin = $request->cin;
        $user->phone_number = $request->phone_number;
        $user->adresse = $request->adresse;


        $photoCin = $request->file('identity_card_image');
        $photoCinName = $request->input('email').'.'. $photoCin->getClientOriginalExtension();
        $photoCin->move('public/images/cin/',$photoCinName);
        $user->identity_card_image = 'public/images/cin/'.$photoCinName;


        if ($request->file('driver_license_image') != null ){
        $photoDriverLc = $request->file('driver_license_image');
        $photoDriverLcName = $request->input('email').'.'.$photoDriverLc->getClientOriginalExtension();
        $photoDriverLc->move('public/images/driverLC',$photoDriverLcName);

        $user->driver_license_image ='public/images/driverLC/'.$photoDriverLcName;
        }   else{ $user->driver_license_image='0';}

        $user->price_km = $request->input('price_km', 0);
        $user->rapidity = $request->input('rapidity', 0);
        $user->Accepted = $request->input('Accepted', 0);

        $user->save();
        return $user;
    }

    public static function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;
        if (!$token = JWTAuth::attempt($input)) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Invalid Email or Password',
                ],
                401
            );
        }
        return response()->json(
            [
                'success' => true,
                'token' => $token,
            ]
        );
    }
}
