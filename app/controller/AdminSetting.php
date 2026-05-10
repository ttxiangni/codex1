<?php
namespace app\controller;

use app\BaseController;
use think\facade\View;
use think\facade\Request;
use think\facade\Config;

class AdminSetting extends BaseController
{
    public function index()
    {
        $settings = Config::get('app');
        View::assign('settings', $settings);
        return View::fetch('admin/setting/index');
    }
    
    public function save()
    {
        $data = Request::post();
        
        // 保存到配置文件或数据库
        // 这里简化为保存到config文件
        
        return json(['code' => 1, 'msg' => '保存成功']);
    }
}