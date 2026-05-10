<?php
namespace app\controller;

use app\BaseController;
use app\model\Seo;
use think\facade\View;
use think\facade\Request;

class AdminSeo extends BaseController
{
    public function index()
    {
        $seos = Seo::order('create_time desc')->paginate(20);
        
        View::assign('seos', $seos);
        return View::fetch('admin/seo/index');
    }
    
    public function add()
    {
        return View::fetch('admin/seo/add');
    }
    
    public function addPost()
    {
        $data = Request::post();
        
        $validate = new \app\validate\Seo;
        if (!$validate->check($data)) {
            return json(['code' => 0, 'msg' => $validate->getError()]);
        }
        
        $seo = new Seo;
        $seo->save($data);
        
        return json(['code' => 1, 'msg' => '添加成功']);
    }
    
    public function edit($id)
    {
        $seo = Seo::find($id);
        View::assign('seo', $seo);
        return View::fetch('admin/seo/edit');
    }
    
    public function editPost($id)
    {
        $data = Request::post();
        
        $validate = new \app\validate\Seo;
        if (!$validate->check($data)) {
            return json(['code' => 0, 'msg' => $validate->getError()]);
        }
        
        $seo = Seo::find($id);
        $seo->save($data);
        
        return json(['code' => 1, 'msg' => '修改成功']);
    }
    
    public function delete($id)
    {
        Seo::destroy($id);
        return json(['code' => 1, 'msg' => '删除成功']);
    }
}