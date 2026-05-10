<?php
namespace app\model;

use think\Model;
use app\service\PinyinService;

class ActorRole extends Model
{
    protected $table = 'ff_actor_role';
    protected $pk = 'actor_role_id';

    protected $schema = [
        'actor_role_id' => 'int',
        'actor_role_actor_id' => 'int',
        'actor_role_vod_id' => 'int',
        'actor_role_name' => 'string',
        'actor_role_en' => 'string',
        'actor_role_description' => 'string',
        'actor_role_sort' => 'int',
        'actor_role_create_time' => 'datetime',
    ];

    public function actor()
    {
        return $this->belongsTo(Actor::class, 'actor_role_actor_id');
    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'actor_role_vod_id');
    }

    // Auto-generate pinyin on save
    protected static function onBeforeInsert($role)
    {
        if (empty($role->actor_role_en) && !empty($role->actor_role_name)) {
            $role->actor_role_en = PinyinService::getSlug($role->actor_role_name);
        }
    }

    protected static function onBeforeUpdate($role)
    {
        if ($role->isDirty('actor_role_name') && !empty($role->actor_role_name)) {
            $role->actor_role_en = PinyinService::getSlug($role->actor_role_name);
        }
    }
}
