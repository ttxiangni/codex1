<?php
namespace app\controller;

use app\BaseController;
use app\model\Actor;
use think\facade\View;
use think\facade\Request;

class AdminActor extends BaseController
{
    public function index()
    {
        $actors = Actor::order('create_time desc')->paginate(20);
        
        View::assign('actors', $actors);
        return View::fetch('admin/actor/index');
    }
    
    public function add()
    {
        return View::fetch('admin/actor/add');
    }
    
    public function addPost()
    {
        $data = Request::post();
        
        $validate = new \app\validate\Actor;
        if (!$validate->check($data)) {
            return json(['code' => 0, 'msg' => $validate->getError()]);
        }
        
        $actor = new Actor;
        $actor->save($data);
        
        return json(['code' => 1, 'msg' => '添加成功']);
    }
    
    public function edit($id)
    {
        $actor = Actor::find($id);
        View::assign('actor', $actor);
        return View::fetch('admin/actor/edit');
    }
    
    public function editPost($id)
    {
        $data = Request::post();
        
        $validate = new \app\validate\Actor;
        if (!$validate->check($data)) {
            return json(['code' => 0, 'msg' => $validate->getError()]);
        }
        
        $actor = Actor::find($id);
        $actor->save($data);
        
        return json(['code' => 1, 'msg' => '修改成功']);
    }
    
    public function delete($id)
    {
        Actor::destroy($id);
        return json(['code' => 1, 'msg' => '删除成功']);
    }
}