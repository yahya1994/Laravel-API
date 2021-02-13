<?php


namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Model\User;
use JWTAuth;
use Closure;
class DeliveryManAccess
{

    protected $user;
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    /**  
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request,Closure $next)
    {   if (  $this->user->role == User::ROLE['DELIVERY_MAN'] AND $this->user->Accepted == User::ACCEPTED['NON'] ) {
         //   return $next($request);
            return redirect()->route('login');
    };
        return response()->json(
            [
                'success' => false,
                'message' =>__('messages.MIDDLEWARE_ERROR')
            ],
            400
        );
    }
}
