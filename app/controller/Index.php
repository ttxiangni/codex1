<?php

namespace app\controller;

use app\BaseController;
use app\model\Video;
use app\model\Category;
use app\model\Comment;
use think\facade\View;

class Index extends BaseController
{
    public function index()
    {
        $videos = Video::where('vod_status', 1)
            ->order('vod_create_time', 'desc')
            ->paginate(20);
        $categories = Category::where('type_status', 1)
            ->order('type_sort', 'asc')
            ->select();

        View::assign('videos', $videos);
        View::assign('categories', $categories);
        return View::fetch();
    }

    public function category($slug)
    {
        if (is_numeric($slug)) {
            $category = Category::find($slug);
        } else {
            $category = Category::where('type_en', $slug)->find();
        }

        if (!$category) {
            return $this->error('分类不存在');
        }

        $videos = Video::where('type_id', $category->type_id)
            ->where('vod_status', 1)
            ->order('vod_create_time', 'desc')
            ->paginate(20);

        View::assign('videos', $videos);
        View::assign('category', $category);
        return View::fetch('index');
    }

    public function categoryEn($en)
    {
        $category = Category::where('type_en', $en)->find();
        if (!$category) {
            return $this->error('分类不存在');
        }

        $videos = Video::where('type_id', $category->type_id)
            ->where('vod_status', 1)
            ->order('vod_create_time', 'desc')
            ->paginate(20);

        View::assign('videos', $videos);
        View::assign('category', $category);
        return View::fetch('index');
    }
    public function search()
    {
        $keyword = input('keyword');
        if (!$keyword) {
            $this->error('请输入搜索关键词');
        }

        $videos = Video::where('vod_name', 'like', '%' . $keyword . '%')
            ->where('vod_status', 1)
            ->order('vod_create_time', 'desc')
            ->paginate(20, false, ['query' => ['keyword' => $keyword]]);

        $categories = Category::where('type_status', 1)
            ->order('type_sort', 'asc')
            ->select();

        View::assign('videos', $videos);
        View::assign('categories', $categories);
        View::assign('keyword', $keyword);
        return View::fetch();
    }

    public function video($slug)
    {
        if (is_numeric($slug)) {
            $video = Video::find($slug);
        } else {
            $video = Video::where('vod_en', $slug)->find();
        }

        if (!$video) {
            return $this->error('视频不存在');
        }

        $relatedVideos = Video::where('type_id', $video->type_id)
            ->where('vod_id', '<>', $video->vod_id)
            ->where('vod_status', 1)
            ->order('vod_create_time', 'desc')
            ->limit(8)
            ->select();

        $comments = Comment::with(['user', 'replies.user'])
            ->where('comment_vod_id', $video->vod_id)
            ->where('comment_parent_id', 0)
            ->where('comment_status', 1)
            ->order('comment_create_time', 'desc')
            ->paginate(10);

        View::assign('video', $video);
        View::assign('relatedVideos', $relatedVideos);
        View::assign('comments', $comments);
        return View::fetch();
    }

    public function videoEn($en)
    {
        $video = Video::where('vod_en', $en)->find();
        if (!$video) {
            return $this->error('视频不存在');
        }

        $relatedVideos = Video::where('type_id', $video->type_id)
            ->where('vod_id', '<>', $video->vod_id)
            ->where('vod_status', 1)
            ->order('vod_create_time', 'desc')
            ->limit(8)
            ->select();

        $comments = Comment::with(['user', 'replies.user'])
            ->where('comment_vod_id', $video->vod_id)
            ->where('comment_parent_id', 0)
            ->where('comment_status', 1)
            ->order('comment_create_time', 'desc')
            ->paginate(10);

        View::assign('video', $video);
        View::assign('relatedVideos', $relatedVideos);
        View::assign('comments', $comments);
        return View::fetch('video');
    }

    public function play($id)
    {
        $video = Video::find($id);
        if (!$video) {
            return $this->error('视频不存在');
        }

        $relatedVideos = Video::where('type_id', $video->type_id)
            ->where('vod_id', '<>', $id)
            ->where('vod_status', 1)
            ->order('vod_create_time', 'desc')
            ->limit(12)
            ->select();

        View::assign('video', $video);
        View::assign('relatedVideos', $relatedVideos);
        return View::fetch();
    }
}
