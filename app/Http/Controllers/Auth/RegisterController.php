<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Setting;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/account';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:users',
            'country_id' => 'required',
            'contact_name' => 'required|string|min:3',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'g-recaptcha-response' => 'required|captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    protected function create(array $data)
    {
        $confirmation_code = str_random(60);
        $user = User::create([
            'name' => str_slug ($data['name']),
            'country_id' => $data['country_id'],
            'contact_name' => $data['contact_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'validation_code'=> $confirmation_code,
        ]);
        $settings =Setting::first();
        $email_data = array(
          'name' => $data['name'],
          'email' => $data['email'],
          'confirmation_code' => $confirmation_code,
          'settings' => $settings,
       );
       // dd($email_data);

        Mail::send('emails.account_verify', $email_data, function($message)use($email_data,$settings)  {
            $message->from($settings->site_email,$settings->site_name);
            $message->to($email_data['email'], $email_data['name']);
            $message->subject(__('messages.Verify your email address'));
        });
        // dd('die');
        // session()->flash('success','Thanks for signing up! Please check your email.');
        return $user;

    }

    /**
    * Handle a registration request for the application.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function register(Request $request)
   {
       $this->validator($request->all())->validate();

       event(new Registered($user = $this->create($request->all())));

       // $this->guard()->login($user);
       session()->flash('success',__('messages.Thanks for signing up! Please check your email for activation'));

       return redirect('/login');
       // return $this->registered($request, $user)
       //                 ?: redirect($this->redirectPath());
   }
   //Verification
   public function verifyUser($token)
   {
       $user = User::where('validation_code', $token)->first();
       if(isset($user) ){
           if($user->active==0) {
               $user->active = 1;
               $user->validation_code = 0;
               $user->save();
               session()->flash('success',__('messages.Your e-mail is verified. You can now login'));

               $settings =Setting::first();
               $email_data = array(
                 'name' => $user['name'],
                 'email' => $user['email'],
                 'url' => $user['url'],
                 'contact_name' => $user['contact_name'],
                 'settings' => $settings,
              );

               Mail::send('emails.welcome', $email_data, function($message)use($email_data,$settings)  {
                   $message->from($settings->site_email,$settings->site_name);
                   $message->to($email_data['email'], $email_data['name']);
                   $message->subject(__('messages.Account Activated'));
               });

           }elseif($user->active==1){
               session()->flash('info',__('messages.Your e-mail is already verified. You can now login'));

           }
       }else{
           session()->flash('error',__('messages.Sorry your email cannot be identified'));
           return redirect('/login');
       }

       // return redirect('/login')->with('status', $status);
       // session()->flash('success','Your e-mail is verified. You can now login.');
       return redirect('/login');
   }
}
