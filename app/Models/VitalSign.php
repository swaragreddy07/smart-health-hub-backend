<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VitalSign extends Model
{
    use HasFactory;
    protected $fillable = [ 'user_id', 'category', 'value', 'date'];

    protected $table = 'table_vital_signs';
    protected $primaryKey='sign_id';
}
