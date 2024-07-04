<?php
// Appointment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments'; // Specify the table name if it's different from the model name in plural form
    
    protected $primaryKey = 'appointment_id'; // Specify the custom primary key  
    
    protected $fillable = ['user_id', 'appointment_date', 'appointment_time', 'provider_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   
}
