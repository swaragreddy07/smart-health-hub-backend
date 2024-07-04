<?php
// User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = [ 'password', 'email', 'full_name', 'role_id','activated','dob','gender','phoneNumber','speciality', 'qualification', 'license_number', 'city'];

    protected $table = 'dbt_user';
    protected $primaryKey='user_id';
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    
    public function address()
    {
        return $this->hasOne(Address::class, 'user_id');
    }
  
}
