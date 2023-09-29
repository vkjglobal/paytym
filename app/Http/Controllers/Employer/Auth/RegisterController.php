<?php

namespace App\Http\Controllers\Employer\Auth;

use App\Console\Commands\SplitPayment;
use App\Models\Employer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Mail\SendEmployerPassword;
use App\Models\Country;
use App\Mail\EmployerRegisterEmailToAdmins;
use App\Models\AdminEmails;
use Exception;
use Illuminate\Support\Facades\Storage;
use symfony\Component\Mailer\Exception\TransportExceptionInterface;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new admins as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    

    /**
     * Where to redirect employers after registration.
     *
     * @var string
     */
    protected $redirectTo = '/employer';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('employer.guest:employer');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array request
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => 'required|string',
    //         'company_name' => 'required|string',
    //         'email' => 'required|email|unique:employers,email',
    //         'phone' => 'required',
    //         'company_phone' => 'required',
    //         'street' => 'required|string',
    //         'city' => 'required|string',
    //         'country' => 'required|string',
    //         'tin' => 'required|string',
    //         'website' => 'nullable|url',
    //         'registration_certificate' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif,svg',
    //         'logo' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif,svg',
    //     ]);
    // }

    /**
     * Create a new employer instance after a valid registration.
     *
     * @param array $data
     *
     * @return \App\Models\Employer
     */
    // protected function create(array $data)
    // {
    //     return Employer::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }

    protected function register(Request $request)
    {
        $request = $request->validate([
            'name' => 'required|string',
            'company_name' => 'required|string',
            'email' => 'required|email|unique:employers,email',
            'phone' => 'required',
            'company_phone' => 'required',
            'street' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'tin' => 'required|string',
            'website' => 'nullable|url',
            'registration_certificate' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif,svg',
            'logo' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif,svg',
        ]);
            

        $rand_pass =  Str::random(8);
        $employer = new Employer();
        $employer->name = $request['name'];
        $employer->company = $request['company_name'];
        $email = $request['email'];
        $employer->email = $email;
        $employer->phone = $request['phone'];
        $employer->company_phone = $request['company_phone'];
        $employer->tin = $request['tin'];
        $employer->country_id = $request['country'];
        $employer->street = $request['street'];
        $employer->city = $request['city'];
        $employer->website = $request['website'];
        $employer->user_type = "Employer"; 
        $employer->status = 1;
        // $employer->qr_code = QrCode::size(250)->generate($employer->company);

        $employer->password = Hash::make($rand_pass);
        try{
           $issend = Mail::to($email)->send(new SendEmployerPassword($rand_pass));
        } catch (TransportExceptionInterface $e){
            notify()->error(__('Failed to Register. Please check the email and try again'));
            return redirect()->back();
        }
        // if(!$mail_res){
            
        // }
            
            
        if (isset($request['registration_certificate'])) {
            $path =  $request['registration_certificate']->storeAs(
                'uploads/certificate',
                urlencode(time()) . '_' . uniqid() . '_' . $request['registration_certificate']->getClientOriginalName(),
                'public'
            );
            $employer->registration_certificate = $path;
        }

        if (isset($request['logo'])) {
            $path =  $request['logo']->storeAs(
                'uploads/logo',
                urlencode(time()) . '_' . uniqid() . '_' . $request['logo']->getClientOriginalName(),
                'public'
            );
            $employer->logo = $path;
        }
       
        $res = $employer->save();

        
        if ($res) {
            $employer->qr_code = QrCode::size(250)->format('svg')->generate($employer->id);
            $employer->save();

            $adminEmails = AdminEmails::get()->pluck('email');
            $recipients = $adminEmails->toArray();
           if ($adminEmails->count()>0) {
            Mail::to($recipients)->send(new EmployerRegisterEmailToAdmins($employer));
            } 

            Auth::guard('employer')->login($employer);
            notify()->success(__('Password sent to your registered email'));
            return redirect('/employer');
        } else {
            notify()->error(__('Failed to Register. Please try again'));
            return redirect()->back();

        }
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $country = Country::get();
        return view('employer.auth.register', compact('country'));
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('employer');
    }
}
