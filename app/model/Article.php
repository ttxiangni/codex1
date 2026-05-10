<?php
namespace app\model;

use think\Model;

class Article extends Model
{
    protected $table = 'ff_article';
    protected $pk = 'article_id';

    protected $schema = [
        'article_id' => 'int',
        'article_category_id' => 'int',
        'article_title' => 'string',
        'article_content' => 'string',
        'article_author' => 'string',
        'article_thumbnail' => 'string',
        'article_description' => 'string',
        'article_keywords' => 'string',
        'article_views' => 'int',
        'article_status' => 'int',
        'article_is_recommend' => 'int',
        'article_create_time' => 'datetime',
        'article_update_time' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }

    public function getSeoAttribute()
    {
        return [
            'title' => $this->article_title,
            'keywords' => $this->article_keywords,
            'description' => $this->article_description,
        ];
    }
}
