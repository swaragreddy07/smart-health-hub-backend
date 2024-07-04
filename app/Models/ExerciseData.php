<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseData extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [ 'user_id', 'category', 'calories', 'date'];

    protected $table = 'excercise_data';
    protected $primaryKey='excercise_id';
}
