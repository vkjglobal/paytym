<?php

namespace App\Models;

use App\Notifications\Employer\Auth\ResetPassword;
use App\Notifications\Employer\Auth\VerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function get_active_employees()
    {
        $active_employees = User::where('employer_id', $this->id)->where('status', 'like', '1')->count();
        return $active_employees;
    }

    public function get_inactive_employees()
    {
        $inactive_employees = User::where('employer_id', $this->id)->where('status', 'like', '0')->count();
        return $inactive_employees;
    }

}