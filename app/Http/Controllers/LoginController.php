<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function signIn(Request $request){
        $this->validate($request, [
            'email' => 'email| required',
            'password' => 'required| min:4'
        ]);

        if(auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {
            if (auth()->user()->role === 'admin') {
                return redirect()->route('categories.index');
            } 
            else {
                return redirect()->route('brand.index');
            }
        }
        else { 
            return redirect()->route('user.signin')
                ->with('error','Email Address And Password Are Wrong.');
        }

    }

    public function logOut(){
        Auth::logout();
        return redirect()->guest('/');
    }
}
