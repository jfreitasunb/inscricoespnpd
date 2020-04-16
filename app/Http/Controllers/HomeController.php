<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Auth;
use Session;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function setaLocale($locale)
    {
        if(Auth::check()){

           $user = User::find(Auth::user()->id_user);

           $user->update(['locale'=>$locale]);

        }else{
            
            Session::put('locale',$locale);
        }
    }

    public function getLangPortuguese()
    {
        $this->setaLocale('pt-br');

        return redirect()->back();
    }

    public function getLangEnglish()
    {
        $this->setaLocale('en');

        return redirect()->back();
    }

    public function getLangSpanish()
    {
        $this->setaLocale('es');

        return redirect()->back();
    }   
}
