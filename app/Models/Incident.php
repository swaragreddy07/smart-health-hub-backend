<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;
    protected $fillable = [ 'incident_time', 'description', 'email','role','status'];

    protected $table = 'incidents';
    protected $primaryKey='incident_id';
}
