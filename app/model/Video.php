<?php
namespace app\model;

use think\Model;
use app\service\PinyinService;

class Video extends Model
{
    protected $table = 'ff_vod';
    protected $pk = 'vod_id';

    protected $schema = [
        'vod_id' => 'int',
        'type_id' => 'int',
        'vod_name' => 'string',
        'vod_en' => 'string',
        'vod_pic' => 'string',
        'vod_actor' => 'string',
        'vod_director' => 'string',
        'vod_writer' => 'string',
        'vod_year' => 'string',
        'vod_area' => 'string',
        'vod_lang' => 'string',
        'vod_content' => 'string',
        'vod_score' => 'float',
        'vod_hits' => 'int',
        'vod_status' => 'int',
        'vod_is_vip' => 'int',
        'vod_play_url' => 'string',
        'vod_download_url' => 'string',
        'vod_keywords' => 'string',
        'vod_letter' => 'string',
        'vod_create_time' => 'datetime',
        'vod_update_time' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'type_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'comment_vod_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'favorite_vod_id');
    }

    // Auto-generate pinyin on save
    protected static function onBeforeInsert($video)
    {
        if (empty($video->vod_en) && !empty($video->vod_name)) {
            $video->vod_en = PinyinService::getSlug($video->vod_name);
        }
    }

    protected static function onBeforeUpdate($video)
    {
        if ($video->isDirty('vod_name') && !empty($video->vod_name)) {
            $video->vod_en = PinyinService::getSlug($video->vod_name);
        }
    }
}
