<?php


namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use App\Model\Reclamation;
use Tymon\JWTAuth\Contracts\Providers\Auth;
use Tymon\JWTAuth\JWT;

class ReclamationRepository
{
    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return Reclamation::create($attributes);
    }
    public   function getReportStats()
    { 
         
      
        $reports["Jan"] =Reclamation::where('created_at' ,'>=','2020-01-01')->where('created_at' ,'<=','2020-01-31')->count(); 
        $reports["Fev"] =Reclamation::where('created_at' ,'>=','2020-02-01')->where('created_at' ,'<=','2020-02-31')->count();
        $reports["Mar"] =Reclamation::where('created_at' ,'>=','2020-03-01')->where('created_at' ,'<=','2020-03-31')->count();
        $reports["avril"] =Reclamation::where('created_at' ,'>=','2020-04-01')->where('created_at' ,'<=','2020-04-31')->count();

        $reports["mai"] =Reclamation::where('created_at' ,'>=','2020-05-01')->where('created_at' ,'<=','2020-05-31')->count();
        $reports["juin"] =Reclamation::where('created_at' ,'>=','2020-06-01')->where('created_at' ,'<=','2020-06-31')->count();
        $reports["Jul"] =Reclamation::where('created_at' ,'>=','2020-07-01')->where('created_at' ,'<=','2020-07-31')->count();
        $reports["Aug"] =Reclamation::where('created_at' ,'>=','2020-08-01')->where('created_at' ,'<=','2020-08-31')->count();
        $reports["Sep"] =Reclamation::where('created_at' ,'>=','2020-09-01')->where('created_at' ,'<=','2020-09-31')->count();
        $reports["Oct"] =Reclamation::where('created_at' ,'>=','2020-10-01')->where('created_at' ,'<=','2020-10-31')->count();
        $reports["Nov"] =Reclamation::where('created_at' ,'>=','2020-11-01')->where('created_at' ,'<=','2020-11-31')->count();
        $reports["Dec"] =Reclamation::where('created_at' ,'>=','2020-12-01')->where('created_at' ,'<=','2020-12-31')->count();
              return  $reports ;
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
        public function update(Request $request, $id)
        {
            $parcel = Auth::user()->Reclamation()->find($id);
            return $parcel;
        }


        public  function  show ($id ) {
          return auth()->user()->parcel()->find($id)->reclamation()->get();

        }

    public  function  showDetails ($id,$rec_id ) {
        return auth()->user()->parcel()->find($id)->reclamation()->find($rec_id);

    }


}
