<?php
namespace app\model;

use think\Model;

class Favorite extends Model
{
    protected $table = 'ff_favorite';
    protected $pk = 'favorite_id';

    protected $schema = [
        'favorite_id' => 'int',
        'favorite_user_id' => 'int',
        'favorite_vod_id' => 'int',
        'favorite_article_id' => 'int',
        'favorite_create_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'favorite_user_id');
    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'favorite_vod_id');
    }
}
