<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    //
    public function show()
    {
        if(Auth::check()){
            return redirect()->route('home.index');
        }
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();
        
        if(!Auth::validate($credentials)):
            //dd('error');
           return redirect()->to('login')
                ->withErrors(trans('auth.failed'));
        endif;
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        

        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    protected function authenticated(Request $request, $user) {
        $roleId = $user->id_rol;
        // Verificar el id_rol y redirigir a la vista correspondiente
        if ($roleId == 1) {
            // Redirigir a la vista de administrador
            return redirect()->route('admin.home');
        } elseif ($roleId == 2) {
            // Redirigir a la vista de usuarios
            //return redirect()->route('user.index');
            return redirect()->route('home.index');
        }
        //return redirect()->route('home.index');
        //return redirect()->route('.index');
    }
}
