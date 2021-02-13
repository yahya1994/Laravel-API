<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRegistrationFormRequest;
use App\Model\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function DeliveryManRegistrationResponse($id)
    {
        $user = UserRepository::Accepted($id);
        return response()->json($user, 200);
    }



    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ConnectedUser()
    {
        $user = auth()->user();
        return response()->json([  $user], 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function client(Request $request)
    {   $name  = $request->name;
        $user = UserRepository::getClient($name );
        if (!$user) {
            return response()->json(
                [
                    'success' => false,
                    'message' => __('messages.CLIENT_SEARCH_ERROR')
                ],
                400
            );
        } else {
            return response()->json($user, 200);
        }
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function registrationRequest(Request $request)
    {   $name  = $request->name;
        $user = UserRepository::getDeliveryManInAccepted($name);
        return response()->json($user, 200);
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function statsClient()
    {
        $user = UserRepository::getClientStats();
        return response()->json(
            [
                'user' => $user
            ],
            200
        );
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function statsDeliveryMan()
    {
        $user = UserRepository::getDeliveryManStats();
        return response()->json(
            [
                'user' => $user
            ],
            200
        );
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function clientCount()
    {
        $user = UserRepository::getClientNumber(User::ROLE['CLIENT']);
        return response()->json($user, 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function DeliveryManCount()
    {
        $user = UserRepository::getDeliveryManNumber();
        return response()->json($user, 200);
    }



    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function deliveryMan(Request $request)
    {    $name=$request->name;
        $user = UserRepository::getDeliveryMan($name);

            return response()->json($user, 200);

    }

    /**
     * @return mixed
     */
    public function index()
    {
        return User::paginate();
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = UserRepository::show($id);
        if (!$user) {
            return response()->json(
                [
                    'success' => false,
                    'message' => __('messages.USER_SEARCH_ERROR')
                ],
                400
            );
        } else {
            return response()->json($user, 200);
        }
    }

    /**
     * @param ClientRegistrationFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ClientRegistrationFormRequest $request)
    {
        $user = UserRepository::create($request);
        return response()->json($user, 201);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = UserRepository::delete($id);
        if (!$user) {
            return response()->json(
                [
                    'success' => false,
                    'message' => __('messages.USER_SEARCH_ERROR') . $id . ' '
                ],
                400
            );
        }
        if ($user->delete()) {
            return response()->json(
                [
                    'success' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => __('messages.USER_DELETE_ERROR')
                ],
                500
            );
        }
    }

    public function test()
    {
        return User::ROLE['CLIENT'];
    }



    public function update(Request $request, $id)
    {   $user = User::find($id);
        if (!$user) {
            return response()->json(
                [
                    'success' => false,
                    'message' =>  __('messages.PARCELS_SHOW_DETAILS_ERROR') . $id . ' .'
                ],
                400
            );
        }

        $updated = $user->fill($request->all())->save();

        if ($updated) {
            return response()->json($user, 201);
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
