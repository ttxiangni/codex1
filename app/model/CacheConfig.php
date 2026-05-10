<?php
namespace app\model;

use think\Model;

class CacheConfig extends Model
{
    protected $table = 'ff_cache_config';
    protected $pk = 'cache_id';

    protected $schema = [
        'cache_id' => 'int',
        'page_name' => 'string',
        'cache_key' => 'string',
        'cache_ttl' => 'int',
        'cache_enabled' => 'int',
        'description' => 'string',
        'cache_addtime' => 'datetime',
        'cache_updatetime' => 'datetime',
    ];

    public function getIdAttr($value, $data)
    {
        return $data['cache_id'] ?? $value;
    }
}
