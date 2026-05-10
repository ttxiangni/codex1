<?php
namespace app\model;

use think\Model;

class ArticleCategory extends Model
{
    protected $table = 'ff_article_category';
    protected $pk = 'article_category_id';

    protected $schema = [
        'article_category_id' => 'int',
        'article_category_name' => 'string',
        'article_category_description' => 'string',
        'article_category_sort' => 'int',
        'article_category_status' => 'int',
        'article_category_create_time' => 'datetime',
        'article_category_update_time' => 'datetime',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'article_category_id');
    }
}
