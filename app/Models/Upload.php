<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FileType;

class Upload extends Model
{
    use HasFactory;

    public function employer(){

        return $this->belongsTo(Employer::class);

    }
    public function filetype(){

        return $this->belongsTo(FileType::class,'file_type_id');

    }
}
