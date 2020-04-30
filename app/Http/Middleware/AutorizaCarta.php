<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ConfiguraInscricaoPNPD;
use Alert;

class AutorizaCarta
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

        $autoriza_carta = $inscricao->autoriza_carta();

        if (!$autoriza_carta) {

            Alert::error('Dear professor, the deadline for sending letters is closed.');

            return redirect('/');
        }

        return $next($request);
    }
}
