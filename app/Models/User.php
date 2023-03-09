<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function leaveRequest()
    {
        return $this->hasMany(LeaveRequest::class);
    }
    public function paymentAdvance()
    {
        return $this->hasMany(PaymentAdvance::class);
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function providentfund()
    {
        return $this->hasOne(ProvidentFund::class);
    }

    public function business()
    {
        return $this->belongsTo(EmployerBusiness::class,'business_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }

    public function role()
    {
        return $this->hasOne(Role::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function assign_allowance()
    {
        return $this->hasMany(AssignAllowance::class, 'user_id');
    }

    public function assign_deduction()
    {
        return $this->hasMany(AssignDeduction::class, 'user_id');
    }

    public function payroll()
    {
        return $this->hasOne(Payroll::class, 'user_id');
    }

    public function position()
    {
        return $this->belongsTo(Role::class, 'position');
    }

    public function total_allowance()
    {
        $total = 0;
        foreach($this->assign_allowance as $assign)
        {
            $total += $assign->rate;
        }
        return $total;
    }

    public function total_deduction()
    {
        $total = 0;
        foreach($this->assign_deduction as $assign)
        {
            $total += $assign->rate;
        }
        return $total;
    }
    
    

    //attendance report
    public function attendanceReport($date_from, $date_to)
    {
        (float)$hours = 0;
        if(!$date_to && !$date_from){
            $user = User::where('id', $this->id)->first();
            $attendances = Attendance::where('user_id', $this->id)->whereBetween('date',[$user->employment_start_date, Carbon::now()])->get();
            foreach($attendances as $attend){
                $check_in = Carbon::parse($attend->check_in);
                $check_out = Carbon::parse($attend->check_out);
                if ($check_in != NULL && $check_out != NULL){
                    $hours += $check_in->diffInHours($check_out);
                }
            }
            return $hours;
        }
        if(!$date_to){
            $attendances = Attendance::where('user_id', $this->id)->whereBetween('date',[$date_from, Carbon::now()])->get();
            foreach($attendances as $attend){
                $check_in = Carbon::parse($attend->check_in);
                $check_out = Carbon::parse($attend->check_out);
                if ($check_in != NULL && $check_out != NULL){
                    $hours += $check_in->diffInHours($check_out);
                }
            }
            return $hours;
        }
        $attendances = Attendance::where('user_id', $this->id)->whereBetween('date',[$date_from, $date_to])->get();
        foreach($attendances as $attend){
            $check_in = Carbon::parse($attend->check_in);
            $check_out = Carbon::parse($attend->check_out);
            if ($check_in != NULL && $check_out != NULL){
                $hours += $check_in->diffInHours($check_out);
            }
            // return $hours;
        }
        return $hours;

        // $attendances = Attendance::where(Auth::guard('employer')->id())->where('user_id', $this->id)->get();
    }

    public function leaves()
    {
        return LeaveRequest::where('user_id', $this->id)->where('status', '1')->count();
    }

    public function total_attendance()
    {
        $fullday = Attendance::where('user_id', $this->id)->where('status', '1')->count();
        $halfday = Attendance::where('user_id', $this->id)->where('status', '0')->count();

        return $fullday + ($halfday/2);
    }

    public function projects()
    {
        return EmployeeProject::where('employee_id', $this->id)->count();
    }

}
