<?php
namespace app\model;

use think\Model;

class Spider extends Model
{
    protected $table = 'ff_spider';
    protected $pk = 'spider_id';

    protected $schema = [
        'spider_id' => 'int',
        'spider_name' => 'string',
        'spider_api' => 'string',
        'spider_type' => 'string',
        'spider_config' => 'json',
        'spider_timeout' => 'int',
        'spider_headers' => 'json',
        'spider_last_fetch' => 'datetime',
        'spider_fetch_count' => 'int',
        'spider_status' => 'int',
        'spider_sort' => 'int',
        'spider_addtime' => 'datetime',
        'spider_updatetime' => 'datetime',
    ];

    public function getIdAttr($value, $data)
    {
        return $data['spider_id'] ?? $value;
    }
}
