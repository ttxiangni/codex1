<?php

namespace app\controller;

use app\BaseController;
use app\model\Video;
use app\model\Category;
use app\model\User;
use app\model\Comment;
use think\facade\View;
use think\facade\Request;

class Admin extends BaseController
{
    public function index()
    {
        return View::fetch();
    }

    // 视频管理
    public function video()
    {
        $videos = Video::order('vod_create_time', 'desc')->paginate(20);
        View::assign('videos', $videos);
        return View::fetch();
    }

    public function videoAdd()
    {
        if (Request::isPost()) {
            $data = Request::post();
            $video = new Video();
            $video->save($data);
            return $this->success('添加成功');
        }

        $categories = Category::where('type_status', 1)->select();
        View::assign('categories', $categories);
        return View::fetch();
    }

    public function videoEdit($id)
    {
        $video = Video::find($id);
        if (!$video) {
            return $this->error('视频不存在');
        }

        if (Request::isPost()) {
            $data = Request::post();
            $video->save($data);
            return $this->success('编辑成功');
        }

        $categories = Category::where('type_status', 1)->select();
        View::assign('video', $video);
        View::assign('categories', $categories);
        return View::fetch();
    }

    public function videoDelete($id)
    {
        $video = Video::find($id);
        if ($video) {
            $video->delete();
            return $this->success('删除成功');
        }
        return $this->error('视频不存在');
    }

    // 分类管理
    public function category()
    {
        $categories = Category::order('type_sort', 'asc')->select();
        View::assign('categories', $categories);
        return View::fetch();
    }

    public function categoryAdd()
    {
        if (Request::isPost()) {
            $data = Request::post();
            $category = new Category();
            $category->save($data);
            return $this->success('添加成功');
        }

        return View::fetch();
    }

    public function categoryEdit($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return $this->error('分类不存在');
        }

        if (Request::isPost()) {
            $data = Request::post();
            $category->save($data);
            return $this->success('编辑成功');
        }

        View::assign('category', $category);
        return View::fetch();
    }

    public function categoryDelete($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return $this->success('删除成功');
        }
        return $this->error('分类不存在');
    }

    // 用户管理
    public function user()
    {
        $users = User::order('user_create_time', 'desc')->paginate(20);
        View::assign('users', $users);
        return View::fetch();
    }

    // 评论管理
    public function comment()
    {
        $comments = Comment::with(['video', 'user'])->order('comment_create_time', 'desc')->paginate(20);
        View::assign('comments', $comments);
        return View::fetch();
    }
}