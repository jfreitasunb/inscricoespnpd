<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ConfiguraInscricaoPNPD;

class AutorizaLogin
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
        $inscricao = new ConfiguraInscricaoPNPD();

        $autoriza_inscricao = $inscricao->autoriza_inscricao();

        if (!$autoriza_inscricao) {
            return redirect('/');
        }

        return $next($request);
    }
}
