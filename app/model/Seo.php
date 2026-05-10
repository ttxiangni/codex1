<?php
namespace app\model;

use think\Model;

class Seo extends Model
{
    protected $table = 'ff_seo';
    protected $pk = 'seo_id';

    protected $schema = [
        'seo_id' => 'int',
        'page_type' => 'string',
        'page_id' => 'int',
        'seo_title' => 'string',
        'seo_keywords' => 'string',
        'seo_description' => 'string',
        'seo_url' => 'string',
        'seo_canonical' => 'string',
        'seo_og_title' => 'string',
        'seo_og_description' => 'string',
        'seo_og_image' => 'string',
        'seo_addtime' => 'datetime',
        'seo_updatetime' => 'datetime',
    ];

    public function getIdAttr($value, $data)
    {
        return $data['seo_id'] ?? $value;
    }
}
