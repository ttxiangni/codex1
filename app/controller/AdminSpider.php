<?php
namespace app\controller;

use app\BaseController;
use app\model\Spider;
use app\service\SpiderService;
use think\facade\View;
use think\facade\Request;

class AdminSpider extends BaseController
{
    public function index()
    {
        $spiders = Spider::order('create_time desc')->paginate(20);
        
        View::assign('spiders', $spiders);
        return View::fetch('admin/spider/index');
    }
    
    public function add()
    {
        return View::fetch('admin/spider/add');
    }
    
    public function addPost()
    {
        $data = Request::post();
        
        $validate = new \app\validate\Spider;
        if (!$validate->check($data)) {
            return json(['code' => 0, 'msg' => $validate->getError()]);
        }
        
        $spider = new Spider;
        $spider->save($data);
        
        return json(['code' => 1, 'msg' => '添加成功']);
    }
    
    public function edit($id)
    {
        $spider = Spider::find($id);
        View::assign('spider', $spider);
        return View::fetch('admin/spider/edit');
    }
    
    public function editPost($id)
    {
        $data = Request::post();
        
        $validate = new \app\validate\Spider;
        if (!$validate->check($data)) {
            return json(['code' => 0, 'msg' => $validate->getError()]);
        }
        
        $spider = Spider::find($id);
        $spider->save($data);
        
        return json(['code' => 1, 'msg' => '修改成功']);
    }
    
    public function delete($id)
    {
        Spider::destroy($id);
        return json(['code' => 1, 'msg' => '删除成功']);
    }
    
    public function collect($id)
    {
        $spider = Spider::find($id);
        if (!$spider) {
            return json(['code' => 0, 'msg' => '采集源不存在']);
        }
        
        $spiderService = new SpiderService();
        $result = $spiderService->collect($spider);
        
        if ($result) {
            return json(['code' => 1, 'msg' => '采集成功']);
        } else {
            return json(['code' => 0, 'msg' => '采集失败']);
        }
    }
}