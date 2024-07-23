<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // ユーザーがログインしていて、adminロールを持っているかをチェック
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            return $next($request);
        }

        // ロールがない場合は、適切なリダイレクト先やエラーメッセージを設定
        return redirect('/')->with('error', 'You do not have admin access.');
    }
}
