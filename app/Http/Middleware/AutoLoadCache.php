<?php

namespace App\Http\Middleware;

use App\Modules\User\Application\Md5User;
use App\Modules\User\Infraestructure\UserRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AutoLoadCache
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $md5Header = $request->header('If-None-Match');
        if (!$request->hasHeader('If-None-Match') || $md5Header == null) {
            return $next($request);
        }
        $instanceUser = new Md5User($this->userRepository);
        $md5 = $instanceUser->convertMd5();
        if ($md5 != $md5Header) {
            return $next($request);
        }
        return response('', 304);
    }
}
