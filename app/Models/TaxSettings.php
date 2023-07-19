<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxSettings extends Model
{
    use HasFactory;
    public $table = "tax_settings";

    public function country(){
        return $this->belongsTo(Country::class);
    }

}
