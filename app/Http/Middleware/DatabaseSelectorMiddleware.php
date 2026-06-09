<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DatabaseSelectorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('db_connection')) {
            $db = session('db_connection');

            if (! in_array($db, ['mysql', 'sqlite'], true)) {
                session()->forget('db_connection');

                return $next($request);
            }

            Config::set('database.default', $db);
            DB::setDefaultConnection($db);
            DB::purge($db);
            DB::reconnect($db);

            if (Auth::check()) {
                $id = Auth::id();
                Auth::forgetUser();
                $user = User::find($id);

                if ($user) {
                    Auth::setUser($user);
                } else {
                    Log::info("User {$id} was not found after switching to the {$db} connection.");
                    Auth::logout();
                }
            }
        }

        return $next($request);
    }
}
