<?php
namespace app\model;

use think\Model;

class Episode extends Model
{
    protected $table = 'ff_episode';
    protected $pk = 'episode_id';

    protected $schema = [
        'episode_id' => 'int',
        'episode_vod_id' => 'int',
        'episode_title' => 'string',
        'episode_number' => 'int',
        'episode_plot' => 'string',
        'episode_director' => 'string',
        'episode_writer' => 'string',
        'episode_actors' => 'string',
        'episode_duration' => 'string',
        'episode_air_date' => 'date',
        'episode_play_url' => 'string',
        'episode_views' => 'int',
        'episode_status' => 'int',
        'episode_create_time' => 'datetime',
        'episode_update_time' => 'datetime',
    ];

    public function video()
    {
        return $this->belongsTo(Video::class, 'episode_vod_id');
    }
}
