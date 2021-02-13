<?php

namespace App\Http\Middleware;

use App\Model\User;
use JWTAuth;
use Closure;
class DeliveryManCheck
{
    protected $user;
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    } 
    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle($request,Closure $next)
    {
            if (  $this->user->role == User::ROLE['DELIVERY_MAN'] AND $this->user->Accepted == User::ACCEPTED['OUI'] ) {
                 return $next($request);
        };

        return response()->json(
            [
                'success' => false,
                'message' => __('messages.MIDDLEWARE_ERROR')
            ],
            400
        );
    }
}
