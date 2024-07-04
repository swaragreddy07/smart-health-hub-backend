<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumComment extends Model
{
    use HasFactory;
    protected $fillable = [ 'post_id', 'user_id', 'content'];

    protected $table = 'forum_comments';

    protected $primaryKey='comment_id';

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post(){
        return $this->belongsTo(ForumPost::class, 'post_id');
    }
}
