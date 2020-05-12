<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    // protected $table = 'users';

    protected $primaryKey = 'usuario_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'email', 'password', 'locale', 'user_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        if (auth()->user()->user_type === 'admin') {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function isCoordenador()
    {
        if (auth()->user()->user_type === 'coordenador') {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function isCandidato()
    {
        if (auth()->user()->user_type === 'candidato') {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function retorna_id_pelo_email($email)
    {
        return $this->select('usuario_id')->where('email', $email)->value('usuario_id');
    }

    public function retorna_user_por_email($email)
    {
        return $this->where('email',$email)->get()->first();
    }

    public function registra_recomendante($novo_recomendante)
    {
        if (is_null($this->retorna_user_por_email($novo_recomendante['email']))){

            $senha_temporaria = str_shuffle(bin2hex(random_bytes(rand(5, 20))).$novo_recomendante['email'].bin2hex(random_bytes(rand(5, 25))));
                
            $novo_usuario = new User();
            $novo_usuario->nome = $novo_recomendante['nome'];
            $novo_usuario->email = $novo_recomendante['email'];
            $novo_usuario->locale = "en";
            $novo_usuario->password = Hash::make($senha_temporaria);
            $novo_usuario->user_type =  "recomendante";
            $novo_usuario->save();

            $id_recomendante = $novo_usuario->usuario_id;

            $inicia_dado = new DadosRecomendante();

            $inicia_dado->id_recomendante = $id_recomendante;

            $inicia_dado->save();
            
        }elseif ($this->retorna_user_por_email($novo_recomendante['email'])->user_type <> "recomendante"){
                return true;
        }
    }
}