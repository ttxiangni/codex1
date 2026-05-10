<?php

namespace app\controller;

use app\BaseController;
use app\model\Actor;
use app\service\CacheService;
use think\facade\View;

class ActorController extends BaseController
{
    public function index()
    {
        $page = request()->param('page', 1);
        $gender = request()->param('gender');
        $keyword = request()->param('keyword');

        $cacheKey = "actors:page:{$page}:gender:{$gender}:keyword:{$keyword}";
        $actors = CacheService::remember($cacheKey, function () use ($page, $gender, $keyword) {
            $query = Actor::where('actor_status', 1);

            if ($gender) {
                $query->where('actor_gender', $gender);
            }

            if ($keyword) {
                $query->whereRaw("(actor_name LIKE ? OR actor_biography LIKE ?)", ["%{$keyword}%", "%{$keyword}%"]);
            }

            return $query->order('actor_create_time', 'desc')->paginate(12);
        }, 3600);

        View::assign('actors', $actors);
        View::assign('gender', $gender);
        View::assign('keyword', $keyword);
        return View::fetch();
    }

    public function detail($slug)
    {
        $cacheKey = "actor:detail:{$slug}";
        $actor = CacheService::remember($cacheKey, function () use ($slug) {
            if (is_numeric($slug)) {
                return Actor::with(['roles.video', 'videos'])->find($slug);
            }
            return Actor::with(['roles.video', 'videos'])->where('actor_en', $slug)->find();
        }, 3600 * 24);

        if (!$actor || $actor->actor_status != 1) {
            return $this->error('演员不存在');
        }

        $videos = $actor->videos()
            ->where('vod_status', 1)
            ->order('vod_create_time', 'desc')
            ->paginate(12);

        $roles = $actor->roles()->with('video')->order('actor_role_sort', 'asc')->select();

        View::assign('actor', $actor);
        View::assign('videos', $videos);
        View::assign('roles', $roles);
        return View::fetch();
    }

    public function byGender($gender = '')
    {
        if (!in_array($gender, ['male', 'female'])) {
            return $this->error('性别参数错误');
        }

        $page = request()->param('page', 1);

        $cacheKey = "actors:gender:{$gender}:page:{$page}";
        $actors = CacheService::remember($cacheKey, function () use ($gender, $page) {
            return Actor::where('actor_gender', $gender)
                ->where('actor_status', 1)
                ->order('actor_create_time', 'desc')
                ->paginate(12);
        }, 3600);

        View::assign('actors', $actors);
        View::assign('gender', $gender);
        return View::fetch('index');
    }
}
