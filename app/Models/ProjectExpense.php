<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectExpense extends Model
{
    use HasFactory;
    public $table = "project_daily_expense";
    protected $fillable = [
        'worked_hours',
        'expense_amount'
       

 ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

   /* public function user(){
        return $this->belongsTo(User::class);
    }*/


}
