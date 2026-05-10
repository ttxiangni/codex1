<?php
namespace app\model;

use think\Model;

class WatchHistory extends Model
{
    protected $table = 'ff_watch_history';
    protected $pk = 'watch_history_id';

    protected $schema = [
        'watch_history_id' => 'int',
        'watch_history_user_id' => 'int',
        'watch_history_vod_id' => 'int',
        'watch_history_episode_id' => 'int',
        'watch_history_progress' => 'int',
        'watch_history_duration' => 'int',
        'watch_history_create_time' => 'datetime',
        'watch_history_update_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'watch_history_user_id');
    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'watch_history_vod_id');
    }
}
