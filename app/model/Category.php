<?php
namespace app\model;

use think\Model;
use app\service\PinyinService;

class Category extends Model
{
    protected $table = 'ff_vod_type';
    protected $pk = 'type_id';

    protected $schema = [
        'type_id' => 'int',
        'type_name' => 'string',
        'type_en' => 'string',
        'type_pid' => 'int',
        'type_sort' => 'int',
        'type_status' => 'int',
        'type_create_time' => 'datetime',
        'type_update_time' => 'datetime',
    ];

    public function videos()
    {
        return $this->hasMany(Video::class, 'type_id');
    }

    // Auto-generate pinyin on save
    protected static function onBeforeInsert($category)
    {
        if (empty($category->type_en) && !empty($category->type_name)) {
            $category->type_en = PinyinService::getSlug($category->type_name);
        }
    }

    protected static function onBeforeUpdate($category)
    {
        if ($category->isDirty('type_name') && !empty($category->type_name)) {
            $category->type_en = PinyinService::getSlug($category->type_name);
        }
    }
}
