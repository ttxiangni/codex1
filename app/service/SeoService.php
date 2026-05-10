<?php
namespace app\service;

use app\model\Seo;
use think\facade\Cache;

class SeoService
{
    /**
     * 获取页面SEO信息
     * @param string $pageType 页面类型
     * @param int $pageId 页面ID (可选)
     * @return array
     */
    public static function getSeo($pageType, $pageId = null)
    {
        $cacheKey = "seo:{$pageType}:{$pageId}";
        
        return Cache::remember($cacheKey, function () use ($pageType, $pageId) {
            $query = Seo::where('page_type', $pageType);
            
            if ($pageId) {
                $query->where('page_id', $pageId);
            }
            
            $seo = $query->first();
            
            return $seo ? [
                'title' => $seo->title,
                'keywords' => $seo->keywords,
                'description' => $seo->description,
                'url' => $seo->url,
                'canonical' => $seo->canonical,
                'og_title' => $seo->og_title,
                'og_description' => $seo->og_description,
                'og_image' => $seo->og_image,
            ] : self::getDefaultSeo($pageType);
        }, 3600 * 24);
    }

    /**
     * 获取默认SEO信息
     * @param string $pageType 页面类型
     * @return array
     */
    public static function getDefaultSeo($pageType)
    {
        $defaults = [
            'index' => [
                'title' => '影视网站 - 看最新最热的视频',
                'keywords' => '影视,视频,电影,电视剧',
                'description' => '提供最新最热的影视资源，高清流畅的在线观看体验',
            ],
            'category' => [
                'title' => '分类页面',
                'keywords' => '分类,视频分类',
                'description' => '查看更多分类视频',
            ],
            'video' => [
                'title' => '视频详情',
                'keywords' => '视频',
                'description' => '查看视频详情',
            ],
            'article' => [
                'title' => '影视资讯',
                'keywords' => '资讯,新闻',
                'description' => '最新的影视资讯',
            ],
            'actor' => [
                'title' => '演员',
                'keywords' => '演员,明星',
                'description' => '影视演员信息',
            ],
        ];

        return $defaults[$pageType] ?? [
            'title' => '影视网站',
            'keywords' => '影视,视频',
            'description' => '在线影视平台',
        ];
    }

    /**
     * 保存SEO信息
     * @param string $pageType 页面类型
     * @param array $seoData SEO数据
     * @param int $pageId 页面ID (可选)
     */
    public static function saveSeo($pageType, $seoData, $pageId = null)
    {
        $seo = Seo::where('page_type', $pageType)
            ->where('page_id', $pageId ?: null)
            ->first() ?? new Seo();

        $seo->page_type = $pageType;
        $seo->page_id = $pageId;
        $seo->title = $seoData['title'] ?? '';
        $seo->keywords = $seoData['keywords'] ?? '';
        $seo->description = $seoData['description'] ?? '';
        $seo->url = $seoData['url'] ?? '';
        $seo->canonical = $seoData['canonical'] ?? '';
        $seo->og_title = $seoData['og_title'] ?? '';
        $seo->og_description = $seoData['og_description'] ?? '';
        $seo->og_image = $seoData['og_image'] ?? '';

        $seo->save();

        // 清除缓存
        $cacheKey = "seo:{$pageType}:{$pageId}";
        Cache::delete($cacheKey);
    }

    /**
     * 生成SEO HTML标签
     * @param array $seo SEO信息
     * @return string
     */
    public static function renderSeoTags($seo)
    {
        $html = '';
        
        if ($seo['title'] ?? false) {
            $html .= sprintf('<meta name="title" content="%s">', htmlspecialchars($seo['title']));
        }
        
        if ($seo['keywords'] ?? false) {
            $html .= sprintf('<meta name="keywords" content="%s">', htmlspecialchars($seo['keywords']));
        }
        
        if ($seo['description'] ?? false) {
            $html .= sprintf('<meta name="description" content="%s">', htmlspecialchars($seo['description']));
        }

        if ($seo['canonical'] ?? false) {
            $html .= sprintf('<link rel="canonical" href="%s">', htmlspecialchars($seo['canonical']));
        }

        // Open Graph标签
        if ($seo['og_title'] ?? false) {
            $html .= sprintf('<meta property="og:title" content="%s">', htmlspecialchars($seo['og_title']));
        }
        
        if ($seo['og_description'] ?? false) {
            $html .= sprintf('<meta property="og:description" content="%s">', htmlspecialchars($seo['og_description']));
        }
        
        if ($seo['og_image'] ?? false) {
            $html .= sprintf('<meta property="og:image" content="%s">', htmlspecialchars($seo['og_image']));
        }

        return $html;
    }
}
