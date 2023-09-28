<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminEmails extends Model
{
    use HasFactory;
    public $table = "super_admin_emails";
    protected $fillable = [
        'name',
        'email'
 ];
}
