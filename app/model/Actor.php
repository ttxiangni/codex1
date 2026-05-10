<?php
namespace app\model;

use think\Model;
use app\service\PinyinService;

class Actor extends Model
{
    protected $table = 'ff_actor';
    protected $pk = 'actor_id';

    protected $schema = [
        'actor_id' => 'int',
        'actor_name' => 'string',
        'actor_en' => 'string',
        'actor_english_name' => 'string',
        'actor_avatar' => 'string',
        'actor_gender' => 'string',
        'actor_birthday' => 'date',
        'actor_height' => 'int',
        'actor_weight' => 'int',
        'actor_constellation' => 'string',
        'actor_blood_type' => 'string',
        'actor_region' => 'string',
        'actor_biography' => 'string',
        'actor_views' => 'int',
        'actor_video_count' => 'int',
        'actor_status' => 'int',
        'actor_create_time' => 'datetime',
        'actor_update_time' => 'datetime',
    ];

    public function videos()
    {
        return $this->belongsToMany(Video::class, 'ff_actor_role', 'actor_role_actor_id', 'actor_role_vod_id');
    }

    public function roles()
    {
        return $this->hasMany(ActorRole::class, 'actor_role_actor_id');
    }

    // Auto-generate pinyin on save
    protected static function onBeforeInsert($actor)
    {
        if (empty($actor->actor_en) && !empty($actor->actor_name)) {
            $actor->actor_en = PinyinService::getSlug($actor->actor_name);
        }
    }

    protected static function onBeforeUpdate($actor)
    {
        if ($actor->isDirty('actor_name') && !empty($actor->actor_name)) {
            $actor->actor_en = PinyinService::getSlug($actor->actor_name);
        }
    }
}
