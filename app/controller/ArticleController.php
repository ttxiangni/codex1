<?php

namespace app\controller;

use app\BaseController;
use app\model\Article;
use app\model\ArticleCategory;
use app\service\CacheService;
use think\facade\View;

class ArticleController extends BaseController
{
    public function index()
    {
        $page = request()->param('page', 1);
        $category_id = request()->param('category_id');

        $cacheKey = "articles:page:{$page}";
        $articles = CacheService::remember($cacheKey, function () use ($page, $category_id) {
            $query = Article::where('article_status', 1);

            if ($category_id) {
                $query->where('article_category_id', $category_id);
            }

            return $query->order('article_create_time', 'desc')->paginate(15);
        }, 3600);

        $categories = ArticleCategory::where('article_category_status', 1)
            ->order('article_category_sort', 'asc')
            ->select();

        View::assign('articles', $articles);
        View::assign('categories', $categories);
        return View::fetch();
    }

    public function detail($id)
    {
        $cacheKey = "article:detail:{$id}";
        $article = CacheService::remember($cacheKey, function () use ($id) {
            return Article::with('category')->find($id);
        }, 3600 * 24);

        if (!$article || $article->article_status != 1) {
            return $this->error('文章不存在');
        }

        $article->increment('article_views');

        $relatedArticles = Article::where('article_category_id', $article->article_category_id)
            ->where('article_id', '<>', $id)
            ->where('article_status', 1)
            ->order('article_create_time', 'desc')
            ->limit(5)
            ->select();

        View::assign('article', $article);
        View::assign('relatedArticles', $relatedArticles);
        return View::fetch();
    }

    public function category($id)
    {
        $page = request()->param('page', 1);

        $category = ArticleCategory::find($id);
        if (!$category || $category->article_category_status != 1) {
            return $this->error('分类不存在');
        }

        $cacheKey = "articles:category:{$id}:page:{$page}";
        $articles = CacheService::remember($cacheKey, function () use ($id, $page) {
            return Article::where('article_category_id', $id)
                ->where('article_status', 1)
                ->order('article_create_time', 'desc')
                ->paginate(15);
        }, 3600);

        View::assign('category', $category);
        View::assign('articles', $articles);
        return View::fetch();
    }
}
