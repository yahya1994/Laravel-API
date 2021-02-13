<?php


namespace App\Http\Middleware;

use App\Model\User;
use Config;
use Closure;
use JWTAuth;
class AdminCheck
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request,Closure $next )
    {

        if (  $this->user->role ==  User::ROLE['ADMIN'] AND $this->user->Accepted == User::ACCEPTED['OUI'] ) {
            return  $next($request);
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
