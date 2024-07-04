<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $primaryKey = 'prescription_id';

    protected $fillable = [
        'provider_id',
        'user_id',
        'medication_name',
        'dosage',
        'frequency',
        'summary',
        'medicines',
        'appointment_id',
        'provider_name',
        'remainder'
        // Add more fields as needed
    ];
    public function medicines()
    {
        return $this->hasMany(Medicine::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function medication()
    {
        return $this->belongsTo(MedicationDispensation::class, 'prescription_id');
    }
  
}
