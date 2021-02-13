<?php

namespace App\Http\Controllers;

use App\Model\Reclamation;
use App\Repositories\ReclamationRepository;
use Illuminate\Http\Request;
use App\Model\Parcel;

class ReclamationController extends Controller
{ var $test  = [];
    /**
     * @var ReclamationRepository
     */
    private $reclamationRepository;

    /**
     * ReclamationController constructor.
     * @param ReclamationRepository $reclamationRepository
     */

    public function __construct(ReclamationRepository $reclamationRepository)
    {
        $this->reclamationRepository = $reclamationRepository;
    }

    /**
     * @return mixed
     */
    public function index(Request $request)
    {   $id=$request->id;
        if ($id !=""){
            $reclamation= Reclamation::orderBy('updated_at','desc')->where('id','LIKE','%'.$id.'%')->paginate(5);  
        foreach ($reclamation as $data) {
            $this->test = $data;
            $this->test['user'] = $data->user()->get();    
            $this->test['parcel'] = $data->parcel()->get();    
             
        }return $reclamation ; }
      
        else{
            $reclamation = Reclamation::paginate(5);
            foreach ($reclamation as $data) {
                $this->test = $data;
                 $this->test['user'] = $data->user()->get();    
            $this->test['parcel'] = $data->parcel()->get();    
                 
            }
            return $reclamation ; }
        }
      

        
   
    public function ReclamationNumber()
    {
        return Reclamation::count() ;
    }
    /**
     * @return mixed
     */
    public function show($id )
    {
        $reclamation = $this->reclamationRepository->show($id );
        return response()->json($reclamation, 200);
    }
    public function ReportStats()
    {
        $reports = $this->reclamationRepository->getReportStats();
        return response()->json(
            [
                'reports' => $reports
            ],
            200
        );
    }
    /**
     * @param $id
     * @param $rec_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showDetail($id,$rec_id )
    {
        $reclamation = $this->reclamationRepository->showDetails($id,$rec_id );
        return response()->json($reclamation, 200);
    }

    public function store(Request $request, $id)
    {
        $request_data = [
            'description' => $request->description,
            'title' => $request->title,
            'parcel_id' => $id,
            'user_id' => auth()->user()->id
        ];
        $reclamation = $this->reclamationRepository->create($request_data);
        return response()->json($reclamation, 200);
    }

}
