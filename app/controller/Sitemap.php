<?php

namespace app\controller;

use app\BaseController;
use app\service\SitemapService;
use think\facade\Response;

class Sitemap extends BaseController
{
    /**
     * 获取网站地图
     */
    public function index()
    {
        $sitemap = SitemapService::generateSitemap();
        return Response::create($sitemap, 'xml');
    }

    /**
     * 获取robots.txt
     */
    public function robots()
    {
        $robots = SitemapService::generateRobots();
        return Response::create($robots, 'text/plain', 200);
    }

    /**
     * 获取sitemap索引
     */
    public function sitemapIndex()
    {
        $index = SitemapService::generateSitemapIndex();
        return Response::create($index, 'xml');
    }
}
