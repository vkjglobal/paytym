<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxSettingsSrtModel extends Model
{
    use HasFactory;
    public $table = "tax_settings_srt";


    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}
