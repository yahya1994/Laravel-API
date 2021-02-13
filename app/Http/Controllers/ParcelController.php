<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParcelFormRequest;
use App\Model\Parcel;
use App\Model\User;
use App\Repositories\ParcelRepository;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\DB;
use OneSignal;
class ParcelController extends Controller
{
    var $test  = [];
    /**
     * @var ParcelRepository
     */
    private $parcelRepository;

    /**
     * ParcelController constructor.
     * @param ParcelRepository $parcelRepository
     */
    public function __construct(ParcelRepository $parcelRepository)
    {
        $this->parcelRepository = $parcelRepository;
    }
 /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {   $input=$request->input;
        $status=$request->status;
        $Receiver_name = Parcel::where('Receiver_name', 'LIKE', '%'.$input.'%');
        $destination_adresse = Parcel::where('destination_adresse', 'LIKE', '%'.$input.'%');
        $starting_adresse = Parcel::where('starting_adresse', 'LIKE', '%'.$input.'%');
        $Receiver_num_Tel = Parcel::where('Receiver_num_Tel', 'LIKE', '%'.$input.'%');
        if  ($status !=""   ) {
            $yahya =auth()->user()->parcel()->orderBy('created_at','desc')->where('status',$status)
            ->paginate(5);
             foreach ($yahya as $data) {
                 $this->test = $data;
                 $this->test['reclamation'] = $data->reclamation()->get();
                 $this->test['DeliveryMan'] = User::where('id',$data->delivery_man_id)->get();
                 $this->test['Client'] = $data->user()->get();
             }  return $yahya ;   }
        if  (  $input !=""   ) {
            $yahya =auth()->user()->parcel()->orderBy('created_at','desc')->where('status',$status)
            ->orWhere('description','LIKE','%'.$input.'%')
            ->union($Receiver_name)
            ->union($starting_adresse)
            ->union($destination_adresse)
            ->union($Receiver_num_Tel)
            ->paginate(5);
             foreach ($yahya as $data) {
                 $this->test = $data;
                 $this->test['reclamation'] = $data->reclamation()->get();
                 $this->test['DeliveryMan'] = User::where('id',$data->delivery_man_id)->get();
                 $this->test['Client'] = $data->user()->get();
             }  return $yahya ;   }
        else{
            $yahya = auth()->user()->parcel()->orderBy('created_at','desc')->paginate(5);
            foreach ($yahya as $data) {
                $this->test = $data;
                $this->test['reclamation'] = $data->reclamation()->get();
                $this->test['DeliveryMan'] = User::where('id',$data->delivery_man_id)->get();
                $this->test['Client'] = $data->user()->get();
                 }return $yahya ; }
}
      /**
     * @return mixed
     */
    public function DeliveryParcel(Request $request){

        $input=$request->input;
        $status=$request->status;
        $Receiver_name = Parcel::where('Receiver_name', 'LIKE', '%'.$input.'%');
        $destination_adresse = Parcel::where('destination_adresse', 'LIKE', '%'.$input.'%');
        $starting_adresse = Parcel::where('starting_adresse', 'LIKE', '%'.$input.'%');
        $Receiver_num_Tel = Parcel::where('Receiver_num_Tel', 'LIKE', '%'.$input.'%');
            if ($status !=""){
           $yahya =Parcel::where('delivery_man_id',auth()->user()->id)->orderBy('created_at','desc')->where('status','LIKE','%'.$status.'%')->paginate(5);
            foreach ($yahya as $data) {
                $this->test = $data;
                $this->test['reclamation'] = $data->reclamation()->get();
                $this->test['DeliveryMan'] = User::where('id',$data->delivery_man_id)->get();
                $this->test['Client'] = $data->user()->get();
            }  return $yahya ;  }
            if  (  $input !=""   ) {
                $yahya =Parcel::where('delivery_man_id',auth()->user()->id)->orderBy('created_at','desc')->where('status',$status)
                ->orWhere('description','LIKE','%'.$input.'%')
                ->union($Receiver_name)
                ->union($starting_adresse)
                ->union($destination_adresse)
                ->union($Receiver_num_Tel)
                ->paginate(5);
                 foreach ($yahya as $data) {
                     $this->test = $data;
                     $this->test['reclamation'] = $data->reclamation()->get();
                     $this->test['DeliveryMan'] = User::where('id',$data->delivery_man_id)->get();
                     $this->test['Client'] = $data->user()->get();
                 }  return $yahya ;   }
            else{
                $yahya = Parcel::where('delivery_man_id',auth()->user()->id)->orderBy('created_at','desc')->paginate(5);
                foreach ($yahya as $data) {
                    $this->test = $data;
                    $this->test['reclamation'] = $data->reclamation()->get();
                    $this->test['DeliveryMan'] = User::where('id',$data->delivery_man_id)->get();
                    $this->test['Client'] = $data->user()->get();

               }return $yahya ; }
    }
    public function getAllAdmin(Request $request)
    {     $input=$request->input;
        $Receiver_name = Parcel::where('Receiver_name', 'LIKE', '%'.$input.'%');
        $destination_adresse = Parcel::where('destination_adresse', 'LIKE', '%'.$input.'%');
        $starting_adresse = Parcel::where('starting_adresse', 'LIKE', '%'.$input.'%');
        $Receiver_num_Tel = Parcel::where('Receiver_num_Tel', 'LIKE', '%'.$input.'%');

        if ($input !=""){
       $yahya = Parcel::orderBy('created_at','desc')->where('status',0)
       ->Where('description','LIKE','%'.$input.'%')
       ->union($Receiver_name)
       ->union($starting_adresse)
       ->union($destination_adresse)
       ->union($Receiver_num_Tel)
       ->paginate(5);
        foreach ($yahya as $data) {
            $this->test = $data;
            $this->test['reclamation'] = $data->reclamation()->get();
            $this->test['DeliveryMan'] = User::where('id',$data->delivery_man_id)->get();
            $this->test['Client'] = $data->user()->get();

        }  return $yahya ; }
        else{
            $yahya = Parcel::orderBy('created_at','desc')->paginate(5);
            foreach ($yahya as $data) {
                $this->test = $data;
                $this->test['reclamation'] = $data->reclamation()->get();
                $this->test['DeliveryMan'] = User::where('id',$data->delivery_man_id)->get();
                $this->test['Client'] = $data->user()->get();


            }return $yahya ; }
        }


    public function getAll(Request $request)
    {     $input=$request->input;
        $Receiver_name = Parcel::where('Receiver_name', 'LIKE', '%'.$input.'%')->where('status',0);
        $destination_adresse = Parcel::where('destination_adresse', 'LIKE', '%'.$input.'%')->where('status',0);
        $starting_adresse = Parcel::where('starting_adresse', 'LIKE', '%'.$input.'%')->where('status',0);
        $Receiver_num_Tel = Parcel::where('Receiver_num_Tel', 'LIKE', '%'.$input.'%')->where('status',0);

        if ($input !=""){
       $yahya = Parcel::orderBy('created_at','desc')->where('status',0)
       ->Where('description','LIKE','%'.$input.'%')
       ->union($Receiver_name)
       ->union($starting_adresse)
       ->union($destination_adresse)
       ->union($Receiver_num_Tel)
       ->paginate(5);
        foreach ($yahya as $data) {
            $this->test = $data;
            $this->test['reclamation'] = $data->reclamation()->get();
            $this->test['DeliveryMan'] = User::where('id',$data->delivery_man_id)->get();
            $this->test['Client'] = $data->user()->get();

        }  return $yahya ; }
        else{
            $yahya = Parcel::orderBy('created_at','desc')->where('status',0)->paginate(5);
            foreach ($yahya as $data) {
                $this->test = $data;
                $this->test['reclamation'] = $data->reclamation()->get();
                $this->test['DeliveryMan'] = User::where('id',$data->delivery_man_id)->get();
                $this->test['Client'] = $data->user()->get();


            }return $yahya ; }
        }

        // return Parcel::paginate();

    public function parcelStats (){
          $parcel= ParcelRepository::ParcelsStats();
        //  return response()->json($parcel, 200);
          return response()->json(
            [
                'parcels' => $parcel
            ],
            200
        );

    }


    public function ParcelNumber(){
        return Parcel::count();
    }



    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $parcel = $this->parcelRepository->show($id);
      //  $parcel['reclamation'] = $parcel->reclamation()->get();// point !!!!!!!!!!!!!
        if (!$parcel) {
            return response()->json(
                [
                    'success' => false,
                    'message' => __('messages.PARCELS_SHOW_DETAILS_ERROR') . $id .''
                ],
                400
            );
        } else {
            return response()->json($parcel, 200);
        }
    }

    public function stats()
    {

      return Parcel::select(DB::raw('count(*) as parcels_count, MONTH(created_at) month'))
      ->groupby('month')
      ->get();

    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $requestData = [
            'description' => $request->description,
            'date' => $request->date,
            'status' => $request->status,
            'cost' => $request->cost,
            'Distance' => $request->Distance,
            'Receiver_name' => $request->Receiver_name,
            'Receiver_num_Tel' => $request->Receiver_num_Tel,
            'starting_longitude'=>$request->starting_longitude,
            'starting_latitude'=>$request->starting_latitude,
            'destination_longitude'=>$request->destination_longitude,
            'destination_latitude'=>$request->destination_latitude,
            'starting_adresse' => $request->starting_adresse,
            'destination_adresse' => $request->destination_adresse,
            'user_id' => auth()->user()->id,
            'delivery_man_id' => $request->input('delivery_man_id', 0)
        ];
        $parcel = $this->parcelRepository->store($requestData);
        OneSignal::sendNotificationToExternalUser(
            'nouvelle colis est disponible',
            2
        );
        return response()->json($parcel, 200);
    }
    public function ParcelToPick($id,$delivery_man_id)
    {
        $parcel = $this->parcelRepository->parcelToPick($id,$delivery_man_id);

        if ($parcel ==1 ){
            OneSignal::sendNotificationToExternalUser(
                'une demande pour livraison est accepter',
                $delivery_man_id
            );
            return response()->json($parcel, 201);}
            else{
                return response()->json(
                    [
                        'success' => false,
                        'message' =>   " cette colis n'est pas encore disponible"
                    ],
                    400
                );
            }
    }

    /* public function active($id)
    {
        $parcel = $this->parcelRepository->parcelTaken($id);

        return response()->json($parcel, 201);


    }*/
    public function active($id,$IDoperation,$Scanner)
    {
        if ($IDoperation==$Scanner){
        $parcel = $this->parcelRepository->parcelTaken($id);
        return response()->json($parcel, 201);
        }else{
            $succes=false;
            return response()->json($succes, 500);
        }

    }




    public function SendInClose($client_id,$distance){
        $Distance = (string)$distance;
        OneSignal::sendNotificationToExternalUser(
            'votre livreur est a '.$Distance.'metre de votre destination',
            $client_id
        );
        return response()->json(
            [
                'success' => true,
                'message' =>   " notification envoyé "
            ],
            201
        );
}
    public function Done($id)
    {
        $parcel = $this->parcelRepository->parcelDone($id);
        return response()->json($parcel, 201);
    }
    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $parcel = $this->parcelRepository::update($request, $id);
        if (!$parcel) {
            return response()->json(
                [
                    'success' => false,
                    'message' =>  __('messages.PARCELS_SHOW_DETAILS_ERROR') . $id . ' .'
                ],
                400
            );
        }

        $updated = $parcel->fill($request->all())->save();

        if ($updated) {
            return response()->json($updated, 201);
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' =>  __('messages.PARCELS_UPDATE_ERROR')
                ],
                500
            );
        }
    }
}
