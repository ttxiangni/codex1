<?php
namespace app\model;

use think\Model;

class Comment extends Model
{
    protected $table = 'ff_comment';
    protected $pk = 'comment_id';

    protected $schema = [
        'comment_id' => 'int',
        'comment_user_id' => 'int',
        'comment_vod_id' => 'int',
        'comment_article_id' => 'int',
        'comment_content' => 'string',
        'comment_parent_id' => 'int',
        'comment_likes' => 'int',
        'comment_status' => 'int',
        'comment_create_time' => 'datetime',
        'comment_update_time' => 'datetime',
    ];

    public function video()
    {
        return $this->belongsTo(Video::class, 'comment_vod_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'comment_user_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'comment_parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'comment_parent_id')->order('comment_create_time', 'asc');
    }
}
