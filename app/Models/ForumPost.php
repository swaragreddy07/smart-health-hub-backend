<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ForumTopics;
use App\Models\User;


class ForumPost extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'user_id', 'topic_id', 'post_date_time'
    ];
    protected $table = "forum_posts";

    protected $primaryKey='post_id';

    public function topic()
   {
    return $this->belongsTo(ForumTopics::class, 'topic_id');
    }

   public function user()
   {
    return $this->belongsTo(User::class, 'user_id');
   }
}
