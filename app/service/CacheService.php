<?php
namespace app\service;

use think\facade\Cache;
use app\model\CacheConfig;

class CacheService
{
    /**
     * 获取缓存，如果不存在则生成
     * @param string $key 缓存键
     * @param callable $callback 生成缓存的回调函数
     * @param int $ttl 缓存时间(秒)，0表示永久
     * @return mixed
     */
    public static function remember($key, $callback, $ttl = 3600)
    {
        $value = Cache::get($key);
        
        if ($value === null) {
            $value = call_user_func($callback);
            if ($ttl > 0) {
                Cache::set($key, $value, $ttl);
            } else {
                Cache::set($key, $value);
            }
        }
        
        return $value;
    }

    /**
     * 设置缓存
     * @param string $key 缓存键
     * @param mixed $value 缓存值
     * @param int $ttl 缓存时间(秒)
     */
    public static function put($key, $value, $ttl = 3600)
    {
        Cache::set($key, $value, $ttl);
    }

    /**
     * 获取缓存
     * @param string $key 缓存键
     * @return mixed
     */
    public static function get($key)
    {
        return Cache::get($key);
    }

    /**
     * 删除缓存
     * @param string $key 缓存键
     */
    public static function forget($key)
    {
        Cache::delete($key);
    }

    /**
     * 根据页面类型获取缓存配置
     * @param string $pageType 页面类型
     * @return array
     */
    public static function getPageCacheConfig($pageType)
    {
        return Cache::remember("cache_config:{$pageType}", function () use ($pageType) {
            $config = CacheConfig::where('page_name', $pageType)
                ->where('cache_enabled', 1)
                ->first();
            
            return $config ? [
                'enabled' => true,
                'ttl' => $config->cache_ttl,
                'key' => $config->cache_key,
            ] : [
                'enabled' => false,
                'ttl' => 0,
            ];
        }, 3600 * 24);
    }

    /**
     * 缓存分页数据
     * @param string $key 缓存键
     * @param callable $callback 获取数据的回调
     * @param int $page 当前页
     * @param int $ttl 缓存时间
     * @return mixed
     */
    public static function rememberPaginate($key, $callback, $page = 1, $ttl = 3600)
    {
        $cacheKey = "{$key}:page:{$page}";
        return self::remember($cacheKey, $callback, $ttl);
    }

    /**
     * 清除分页缓存
     * @param string $key 缓存键
     */
    public static function forgetPaginate($key)
    {
        // 清除所有相关分页缓存
        $pattern = "{$key}:page:*";
        // Redis的扫描删除
        Cache::store('redis')->handler()->evict($pattern);
    }
}
