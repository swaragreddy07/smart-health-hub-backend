<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'prescription_id', 'preference'];

    protected $table = 'alerts';
    protected $primaryKey='alert_id';
}
