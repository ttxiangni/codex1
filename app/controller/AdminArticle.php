<?php
namespace app\controller;

use app\BaseController;
use app\model\Article;
use app\model\ArticleCategory;
use think\facade\View;
use think\facade\Request;
use think\facade\Db;

class AdminArticle extends BaseController
{
    public function index()
    {
        $articles = Article::with('category')
            ->order('create_time desc')
            ->paginate(20);
        
        View::assign('articles', $articles);
        return View::fetch('admin/article/index');
    }
    
    public function add()
    {
        $categories = ArticleCategory::order('sort asc')->select();
        View::assign('categories', $categories);
        return View::fetch('admin/article/add');
    }
    
    public function addPost()
    {
        $data = Request::post();
        
        $validate = new \app\validate\Article;
        if (!$validate->check($data)) {
            return json(['code' => 0, 'msg' => $validate->getError()]);
        }
        
        $article = new Article;
        $article->save($data);
        
        return json(['code' => 1, 'msg' => '添加成功']);
    }
    
    public function edit($id)
    {
        $article = Article::find($id);
        $categories = ArticleCategory::order('sort asc')->select();
        
        View::assign('article', $article);
        View::assign('categories', $categories);
        return View::fetch('admin/article/edit');
    }
    
    public function editPost($id)
    {
        $data = Request::post();
        
        $validate = new \app\validate\Article;
        if (!$validate->check($data)) {
            return json(['code' => 0, 'msg' => $validate->getError()]);
        }
        
        $article = Article::find($id);
        $article->save($data);
        
        return json(['code' => 1, 'msg' => '修改成功']);
    }
    
    public function delete($id)
    {
        Article::destroy($id);
        return json(['code' => 1, 'msg' => '删除成功']);
    }
    
    public function category()
    {
        $categories = ArticleCategory::order('sort asc')->select();
        View::assign('categories', $categories);
        return View::fetch('admin/article/category');
    }
    
    public function categoryAdd()
    {
        return View::fetch('admin/article/category_add');
    }
    
    public function categoryAddPost()
    {
        $data = Request::post();
        
        $category = new ArticleCategory;
        $category->save($data);
        
        return json(['code' => 1, 'msg' => '添加成功']);
    }
    
    public function categoryEdit($id)
    {
        $category = ArticleCategory::find($id);
        View::assign('category', $category);
        return View::fetch('admin/article/category_edit');
    }
    
    public function categoryEditPost($id)
    {
        $data = Request::post();
        
        $category = ArticleCategory::find($id);
        $category->save($data);
        
        return json(['code' => 1, 'msg' => '修改成功']);
    }
    
    public function categoryDelete($id)
    {
        ArticleCategory::destroy($id);
        return json(['code' => 1, 'msg' => '删除成功']);
    }
}