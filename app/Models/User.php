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
    public function extra_details()
    {
        return $this->hasOne(EmployeeExtraDetails::class, 'employee_id');
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
        return $this->hasOne(Role::class, 'id');
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

    public function commission()
    {
        return $this->hasMany(Commission::class, 'user_id');
    }

    // public function bonus()
    // {
    //     return $this->hasMany(Commission::class, 'user_id');
    // }

    public function payroll()
    {
        return $this->hasOne(Payroll::class, 'user_id');
    }
    public function total_provident_fund()
    {
        return $this->payroll()->whereMonth('end_date', Carbon::now())->sum('total_fnpf');
    }
    public function advance()
    {
        return $this->hasMany(PaymentAdvance::class, 'user_id');
    }
    
    public function members()
    {
        return $this->belongsTo(GroupChatMembers::class);
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

    public function total_commission()
    {
        $total = 0;
        foreach($this->commission as $commission)
        {
            $total += $commission->rate;
        }
        return $total;
    }

    public function total_bonus($userId)
    {
        $total = 0;

        $totalEmployee = DB::table('users')
        ->join('bonus', 'users.id', '=', 'bonus.type_id')
        ->where('bonus.type', '=', 0)
        ->where('bonus.rate_type', '=', 1)
        ->where('users.id', '=', $userId)
        ->sum('bonus.rate');

        $totalDepartment = DB::table('users')
        ->join('departments', 'users.department_id', '=', 'departments.id')
        ->join('bonus', 'departments.id', '=', 'bonus.type_id')
        ->where('bonus.type', '=', 1)
        ->where('bonus.rate_type', '=', 1)
        ->where('users.id', '=', $userId)
        ->sum('bonus.rate');

        $totalBranch = DB::table('users')
        ->join('branches', 'users.branch_id', '=', 'branches.id')
        ->join('bonus', 'branches.id', '=', 'bonus.type_id')
        ->where('bonus.type', '=', 2)
        ->where('bonus.rate_type', '=', 1)
        ->where('users.id', '=', $userId)
        ->sum('bonus.rate');

        $totalBusiness = DB::table('users')
        ->join('employer_businesses', 'users.business_id', '=', 'employer_businesses.id')
        ->join('bonus', 'employer_businesses.id', '=', 'bonus.type_id')
        ->where('bonus.type', '=', 3)
        ->where('bonus.rate_type', '=', 1)
        ->where('users.id', '=', $userId)
        ->sum('bonus.rate');

        $total += $totalEmployee + $totalDepartment + $totalBranch + $totalBusiness; 

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

    public function total_tax()
    {
        $payrolls = Payroll::where('user_id', $this->id)->whereYear('created_at', Carbon::now()->year)->get();
        $total_tax = 0;
        foreach($payrolls as $payroll){
            $total_tax = $payroll->total_tax;
        }
        return $total_tax;
    }


}
