<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compliance extends Model
{
    use HasFactory;
    protected $fillable = [ 'name', 'description', 'type', 'status','issue'];

    protected $table = 'compliance';
    protected $primaryKey='compliance_id';
}
