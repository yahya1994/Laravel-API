<?php


namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use App\Model\Parcel;
use App\Model\User;
use Config;
class ParcelRepository
{
    /**
     * @param array $attributes
     * @return mixed
     */
    public   function store(array $attributes)
    {
        return Parcel::create($attributes);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $parcel = Auth::user()->Parcel()->find($id);
        return $parcel;
    }
    public static function ParcelsStats()
    {

          /* return $user = DB::table('parcels')
            ->select(DB::raw('count(*) as parcels_count, MONTH(date) month'))
            ->groupby('month')
            ->get(); */

            $parcel["Jan"] =Parcel::where('date' ,'>=','2020-01-01')->where('date' ,'<=','2020-01-31')->count();
            $parcel["Fev"] =Parcel::where('date' ,'>=','2020-02-01')->where('date' ,'<=','2020-02-31')->count();
            $parcel["Mar"] =Parcel::where('date' ,'>=','2020-03-01')->where('date' ,'<=','2020-03-31')->count();
            $parcel["avril"] =Parcel::where('date' ,'>=','2020-04-01')->where('date' ,'<=','2020-04-31')->count();

            $parcel["mai"] =Parcel::where('date' ,'>=','2020-05-01')->where('date' ,'<=','2020-05-31')->count();
            $parcel["juin"] =Parcel::where('date' ,'>=','2020-06-01')->where('date' ,'<=','2020-06-31')->count();
            $parcel["Jul"] =Parcel::where('date' ,'>=','2020-07-01')->where('date' ,'<=','2020-07-31')->count();
            $parcel["Aug"] =Parcel::where('date' ,'>=','2020-08-01')->where('date' ,'<=','2020-08-31')->count();
            $parcel["Sep"] =Parcel::where('date' ,'>=','2020-09-01')->where('date' ,'<=','2020-09-31')->count();
            $parcel["Oct"] =Parcel::where('date' ,'>=','2020-10-01')->where('date' ,'<=','2020-10-31')->count();
            $parcel["Nov"] =Parcel::where('date' ,'>=','2020-11-01')->where('date' ,'<=','2020-11-31')->count();
            $parcel["Dec"] =Parcel::where('date' ,'>=','2020-12-01')->where('date' ,'<=','2020-12-31')->count();

        return  $parcel ;
    }
    /**
     * @param $id
     * @return mixed
     */
    public  function  show ($id) {
          return $parcel = Parcel::find($id);
        //  $parcel['reclamation'] = $parcel->reclamation()->get() ;
    }
    public function parcelDone ($id){
        $parcel = DB::table('parcels')
            ->where('id', $id)
            ->update(['delivery_man_id'=>auth()->user()->id,'status'=> Config::get('constants.STATUS_DELIVERED')]);

        return $parcel;
    }
    /**
     * @param $id
     * @return int
     */
    public function parcelTaken ($id){
        $parcel = DB::table('parcels')
            ->where('id', $id)
            ->update(['status'=>1]);

        return $parcel;
    }


    public function parcelToPick ($id,$delivery_man_id){
        $parcel = DB::table('parcels')
            ->where('id', $id)
            ->where('status',0)
            ->update(['delivery_man_id'=>$delivery_man_id,'status'=>3]);

        return $parcel;
    }
}
