<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
    public $table = "cms";
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'cms_type',
        'content'
 ];
}
