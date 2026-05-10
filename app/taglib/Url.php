<?php

namespace app\taglib;

use think\template\TagLib;
use think\facade\Config;

/**
 * URL生成自定义标签库
 * 根据系统SEO设置自动生成适当的URL
 */
class Url extends TagLib
{
    protected $tags = [
        'videoUrl'    => ['attr' => 'video', 'close' => 0],
        'categoryUrl' => ['attr' => 'category', 'close' => 0],
        'actorUrl'    => ['attr' => 'actor', 'close' => 0],
    ];

    /**
     * 生成视频URL
     * 根据seo_mode自动选择 id 或 pinyin 路径
     * 
     * @example {videoUrl video=$video /}
     *          输出: /video/123 或 /video/dianying-ming-zi
     */
    public function tagVideoUrl($tag, $content)
    {
        $videoVar = $tag['video'];
        $parse = '<?php $__video__ = ' . $videoVar . ';';
        $parse .= ' if (\think\facade\Config::get("system.seo_mode", "id") === "pinyin" && !empty($__video__->vod_en)) {';
        $parse .= ' echo url("/video/" . $__video__->vod_en);';
        $parse .= ' } else {';
        $parse .= ' echo url("/video/" . $__video__->vod_id);';
        $parse .= ' } ?>';
        return $parse;
    }

    /**
     * 生成分类URL
     * 根据seo_mode自动选择 id 或 pinyin 路径
     * 
     * @example {categoryUrl category=$category /}
     *          输出: /category/1 或 /category/dianying
     */
    public function tagCategoryUrl($tag, $content)
    {
        $categoryVar = $tag['category'];
        $parse = '<?php $__category__ = ' . $categoryVar . ';';
        $parse .= ' if (\think\facade\Config::get("system.seo_mode", "id") === "pinyin" && !empty($__category__->type_en)) {';
        $parse .= ' echo url("/category/" . $__category__->type_en);';
        $parse .= ' } else {';
        $parse .= ' echo url("/category/" . $__category__->type_id);';
        $parse .= ' } ?>';
        return $parse;
    }

    /**
     * 生成演员URL
     * 根据seo_mode自动选择 id 或 pinyin 路径
     * 
     * @example {actorUrl actor=$actor /}
     *          输出: /actor/1 或 /actor/cheng-long
     */
    public function tagActorUrl($tag, $content)
    {
        $actorVar = $tag['actor'];
        $parse = '<?php $__actor__ = ' . $actorVar . ';';
        $parse .= ' if (\think\facade\Config::get("system.seo_mode", "id") === "pinyin" && !empty($__actor__->actor_en)) {';
        $parse .= ' echo url("/actor/" . $__actor__->actor_en);';
        $parse .= ' } else {';
        $parse .= ' echo url("/actor/" . $__actor__->actor_id);';
        $parse .= ' } ?>';
        return $parse;
    }
}
