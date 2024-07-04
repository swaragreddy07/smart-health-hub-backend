<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumTopics extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'description', 'type', 'posts'];

    protected $table = 'forum_topics';
    protected $primaryKey='topic_id';

    public function posts()
    {
        return $this->hasMany(ForumPost::class, 'topic_id');
    }
}
