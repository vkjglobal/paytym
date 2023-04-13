<?php

namespace App\Http\Controllers\Employer\Auth;

use App\Models\Employer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\SendEmployerPassword;
use Swift_TransportException;
use App\Models\Country;
use SwiftTransportException;

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

    use RegistersUsers;

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
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
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
    }

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

    protected function create(array $data)
    {
        $employer = new Employer();
        $employer->name = $data['name'];
        $employer->company = $data['company_name'];
        $email = $data['email'];
        $employer->email = $email;
        $employer->phone = $data['phone'];
        $employer->company_phone = $data['company_phone'];
        $employer->tin = $data['tin'];
        $employer->country_id = $data['country'];
        $employer->street = $data['street'];
        $employer->city = $data['city'];
        $employer->website = $data['website'];
        $employer->user_type = "Employer"; 
        $rand_pass =  Str::random(8);
        $employer->password = Hash::make($rand_pass);
        try {
            $issend =Mail::to($email)->send(new SendEmployerPassword($rand_pass));
            if (!$issend) {
                return redirect()->back()->with('error', 'Email not sent. Please try again later.');
            }
        } catch (Swift_TransportException $e) {
            return redirect()->back()->with('error', 'Invalid email address');
        }
        if (isset($data['registration_certificate'])) {
            $path =  $data['registration_certificate']->storeAs(
                'uploads/certificate',
                urlencode(time()) . '_' . uniqid() . '_' . $data['registration_certificate']->getClientOriginalName(),
                'public'
            );
            $employer->registration_certificate = $path;
        }

        if (isset($data['logo'])) {
            $path =  $data['logo']->storeAs(
                'uploads/logo',
                urlencode(time()) . '_' . uniqid() . '_' . $data['logo']->getClientOriginalName(),
                'public'
            );
            $employer->logo = $path;
        }
        if($issend){
        $res = $employer->save();
        }
        if ($res) {
            notify()->success(__('Password sent to your registered email'));
            return $employer;
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
