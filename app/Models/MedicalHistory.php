<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    use HasFactory;
    protected $fillable = [ 'user_id', 'provider_id', 'appointment_id', 'summary','date','medical_condition', 'provider_name'];

    protected $table = 'medical_history';
    protected $primaryKey='history_id';

    public function doctor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
