<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'account/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout', 'userLogout');
        $this->middleware('guest:admin', ['except' => ['logout', 'adminLogout']]);
    }
    public function userLogout()
    {
      // Auth::guard('web')->logout();
        $this->guard()->logout();
        // $request->session()->invalidate();
        return redirect('/');
    }
    public function authenticated(Request $request, $user)
  {
      if ($user->active==0) {
          auth()->logout();
          session()->flash('error', __('messages.You need to confirm your account. We already sent you an activation code, please check your email') );
          return redirect('/login');
      }
      Auth::guard('admin')->logout(); 
      return redirect()->intended($this->redirectPath());
  }
}
