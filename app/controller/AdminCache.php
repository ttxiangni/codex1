<?php
namespace app\controller;

use app\BaseController;
use app\model\CacheConfig;
use app\service\CacheService;
use think\facade\View;
use think\facade\Request;

class AdminCache extends BaseController
{
    public function index()
    {
        $cacheConfigs = CacheConfig::order('create_time desc')->select();
        
        View::assign('cacheConfigs', $cacheConfigs);
        return View::fetch('admin/cache/index');
    }
    
    public function clear()
    {
        $cacheService = new CacheService();
        $result = $cacheService->clearAll();
        
        if ($result) {
            return json(['code' => 1, 'msg' => '缓存清除成功']);
        } else {
            return json(['code' => 0, 'msg' => '缓存清除失败']);
        }
    }
}