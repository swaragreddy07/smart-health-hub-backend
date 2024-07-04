<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    protected $fillable = [ 'description', 'type', 'value', 'config','affected_data','time', 'status'];

    protected $table = 'table_configuration';
    protected $primaryKey='config_id';
}
