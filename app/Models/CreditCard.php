<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;
    public $table = "credit_cards";
    protected $fillable = [
        'primary_card_number',
        'primary_name_on_card',
        'primary_expiry_date',
        'secondary_name_on_card',
        'secondary_name_on_card',
        'secondary_expiry_date',
        'primary_is_default',
        'secondary_is_default'

 ];

        public function employer()
            {
                return $this->belongsTo(Employer::class);
            }
}
