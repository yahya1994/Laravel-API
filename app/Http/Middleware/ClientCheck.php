<?php


namespace App\Http\Middleware;

use App\Model\User;
use Closure;
use JWTAuth;
class ClientCheck
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
    public function handle($request,Closure $next )
    {

        if (  $this->user->role == User::ROLE['CLIENT']  AND $this->user->Accepted == User::ACCEPTED['OUI']  )
        {
            return $next($request);
        }
        return response()->json(
            [
                'success' => false,
                'message' => __('messages.MIDDLEWARE_ERROR')
            ],
            400
        );
    }

}

