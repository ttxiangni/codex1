<?php
namespace app\controller;

use app\BaseController;
use app\model\Episode;
use app\model\Video;
use think\facade\View;
use think\facade\Request;

class AdminEpisode extends BaseController
{
    public function index()
    {
        $episodes = Episode::with('video')
            ->order('episode_create_time desc')
            ->paginate(20);
        
        View::assign('episodes', $episodes);
        return View::fetch('admin/episode/index');
    }
    
    public function add()
    {
        $videos = Video::order('vod_name asc')->select();
        View::assign('videos', $videos);
        return View::fetch('admin/episode/add');
    }
    
    public function addPost()
    {
        $data = Request::post();
        
        $validate = new \app\validate\Episode;
        if (!$validate->check($data)) {
            return json(['code' => 0, 'msg' => $validate->getError()]);
        }
        
        $episode = new Episode;
        $episode->save($data);
        
        return json(['code' => 1, 'msg' => '添加成功']);
    }
    
    public function edit($id)
    {
        $episode = Episode::find($id);
        $videos = Video::order('vod_name asc')->select();
        
        View::assign('episode', $episode);
        View::assign('videos', $videos);
        return View::fetch('admin/episode/edit');
    }
    
    public function editPost($id)
    {
        $data = Request::post();
        
        $validate = new \app\validate\Episode;
        if (!$validate->check($data)) {
            return json(['code' => 0, 'msg' => $validate->getError()]);
        }
        
        $episode = Episode::find($id);
        $episode->save($data);
        
        return json(['code' => 1, 'msg' => '修改成功']);
    }
    
    public function delete($id)
    {
        Episode::destroy($id);
        return json(['code' => 1, 'msg' => '删除成功']);
    }
}