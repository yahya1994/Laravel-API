<?php


namespace App\Repositories;


use App\Model\DeliveryManInfo;
use Illuminate\Http\Request;

class DeliveryMan_InfoRepository
{

    public   function store(array $attributes)
    {
        return DeliveryManInfo::create($attributes);
    }

    public function update(Request $request, $id)
    {
        $DL_ManInfo= Auth::user()->DeliveryManInfo()->find($id);
        return $DL_ManInfo;
    }
    public  function  show ($id) {
        return   $DL_ManInfo = auth()->user()->DeliveryManInfo()->find($id);
    }


}
