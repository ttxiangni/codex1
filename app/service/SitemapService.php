<?php
namespace app\service;

use app\model\Video;
use app\model\Category;
use app\model\Article;
use app\model\Actor;

class SitemapService
{
    /**
     * 生成网站地图XML
     * @return string
     */
    public static function generateSitemap()
    {
        $host = request()->domain();
        $urls = [];

        // 首页
        $urls[] = [
            'loc' => $host . '/',
            'lastmod' => date('Y-m-d'),
            'changefreq' => 'daily',
            'priority' => '1.0',
        ];

        // 分类页面
        $categories = Category::where('status', 1)->select();
        foreach ($categories as $category) {
            $urls[] = [
                'loc' => $host . '/category/' . $category->id,
                'lastmod' => $category->updated_at,
                'changefreq' => 'daily',
                'priority' => '0.8',
            ];
        }

        // 视频页面
        $videos = Video::where('status', 1)->select();
        foreach ($videos as $video) {
            $urls[] = [
                'loc' => $host . '/video/' . $video->id,
                'lastmod' => $video->updated_at,
                'changefreq' => 'weekly',
                'priority' => '0.6',
            ];
        }

        // 文章页面
        $articles = Article::where('status', 1)->select();
        foreach ($articles as $article) {
            $urls[] = [
                'loc' => $host . '/article/' . $article->id,
                'lastmod' => $article->updated_at,
                'changefreq' => 'weekly',
                'priority' => '0.5',
            ];
        }

        // 演员页面
        $actors = Actor::where('status', 1)->select();
        foreach ($actors as $actor) {
            $urls[] = [
                'loc' => $host . '/actor/' . $actor->id,
                'lastmod' => $actor->updated_at,
                'changefreq' => 'monthly',
                'priority' => '0.4',
            ];
        }

        return self::formatSitemap($urls);
    }

    /**
     * 格式化为XML格式
     * @param array $urls URL列表
     * @return string
     */
    private static function formatSitemap($urls)
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($urls as $url) {
            $xml .= '  <url>' . PHP_EOL;
            $xml .= '    <loc>' . htmlspecialchars($url['loc']) . '</loc>' . PHP_EOL;
            $xml .= '    <lastmod>' . $url['lastmod'] . '</lastmod>' . PHP_EOL;
            $xml .= '    <changefreq>' . $url['changefreq'] . '</changefreq>' . PHP_EOL;
            $xml .= '    <priority>' . $url['priority'] . '</priority>' . PHP_EOL;
            $xml .= '  </url>' . PHP_EOL;
        }

        $xml .= '</urlset>';
        return $xml;
    }

    /**
     * 生成sitemap索引文件
     * @return string
     */
    public static function generateSitemapIndex()
    {
        $host = request()->domain();
        
        $index = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $index .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
        $index .= '  <sitemap>' . PHP_EOL;
        $index .= '    <loc>' . $host . '/sitemap.xml</loc>' . PHP_EOL;
        $index .= '  </sitemap>' . PHP_EOL;
        $index .= '</sitemapindex>';

        return $index;
    }

    /**
     * 生成robots.txt
     * @return string
     */
    public static function generateRobots()
    {
        $host = request()->domain();

        return <<<ROBOTS
User-agent: *
Allow: /
Disallow: /admin/
Disallow: /api/
Disallow: /admin
Disallow: *.php
Disallow: /search

# 搜索引擎爬虫延迟
Crawl-delay: 1

# 网站地图
Sitemap: {$host}/sitemap.xml
ROBOTS;
    }
}
