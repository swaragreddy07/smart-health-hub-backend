<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'street', 'city','state', 'zipcode', 'primary_care','special_care','emergency_care','diagnostic_service', 'operational_status'];

    protected $table = 'facilities';
    protected $primaryKey='facility_id';
}
