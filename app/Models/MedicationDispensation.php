<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicationDispensation extends Model
{
    use HasFactory;
    protected $table = 'medication_dispensation';
    protected $primaryKey='dispensation_id';

    protected $fillable = [
        'prescription_id', 
        'dispensation_date_time',
        'pharmacist_id',
        'user_id'
    ];
    
}
