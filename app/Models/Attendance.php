<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attendance extends Model
{
    public $table = "attendance";
    protected $fillable = [
        'user_id','check_in','check_out','status','approve_reject','reason','date','employer_id',
    ];
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public function attendanceReport($employee, $startDate, $endDate)
    // {
    //     return $this->select(DB::raw('WEEK(date) as week_number, SUM(TIME_TO_SEC(TIMEDIFF(check_out, check_in))/3600) as hours_worked'))
    //                 ->where('user_id', $employee)
    //                 ->whereBetween('date', [$startDate, $endDate])
    //                 ->groupBy('week_number')
    //                 ->get();
    // }
}
