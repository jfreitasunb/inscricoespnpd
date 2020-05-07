<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'nome', 'email', 'password', 'locale',
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
}
