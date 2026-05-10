<?php
namespace app\service;

use think\facade\Http;
use app\model\Spider;
use think\facade\Log;

class SpiderService
{
    /**
     * 获取采集源
     * @param int $spiderId 采集源ID
     * @return \app\model\Spider
     */
    public static function getSpider($spiderId)
    {
        return Spider::find($spiderId);
    }

    /**
     * 获取所有启用的采集源
     * @return array
     */
    public static function getEnabledSpiders()
    {
        return Spider::where('status', 1)->order('sort', 'asc')->select()->toArray();
    }

    /**
     * 采集视频列表（MacCMS格式）
     * @param int $spiderId 采集源ID
     * @param array $params 参数
     * @return array
     */
    public static function fetchVideos($spiderId, $params = [])
    {
        $spider = self::getSpider($spiderId);
        if (!$spider) {
            return ['code' => 1, 'msg' => '采集源不存在'];
        }

        try {
            $url = $spider->api_url;
            
            // 根据采集源类型处理请求
            if ($spider->type === 'maccms') {
                $url .= '/api.php/provide/vod/';
            }

            $response = Http::timeout($spider->request_timeout ?: 30)
                ->withHeaders($spider->headers ? json_decode($spider->headers, true) : [])
                ->get($url, $params);

            $data = json_decode($response->body(), true);

            if ($data && isset($data['list'])) {
                // 记录采集信息
                $spider->update([
                    'last_fetch_time' => date('Y-m-d H:i:s'),
                    'fetch_count' => $spider->fetch_count + count($data['list']),
                ]);

                return ['code' => 0, 'data' => $data['list']];
            }

            return ['code' => 1, 'msg' => '采集数据格式错误'];
        } catch (\Exception $e) {
            Log::error('采集失败: ' . $e->getMessage());
            return ['code' => 1, 'msg' => '采集失败: ' . $e->getMessage()];
        }
    }

    /**
     * 采集视频详情
     * @param int $spiderId 采集源ID
     * @param string $videoId 视频ID
     * @return array
     */
    public static function fetchVideoDetail($spiderId, $videoId)
    {
        $spider = self::getSpider($spiderId);
        if (!$spider) {
            return ['code' => 1, 'msg' => '采集源不存在'];
        }

        try {
            $url = $spider->api_url;
            
            if ($spider->type === 'maccms') {
                $url .= '/api.php/provide/vod/at/json/';
            }

            $response = Http::timeout($spider->request_timeout ?: 30)
                ->withHeaders($spider->headers ? json_decode($spider->headers, true) : [])
                ->get($url, ['ids' => $videoId]);

            $data = json_decode($response->body(), true);
            return ['code' => 0, 'data' => $data];
        } catch (\Exception $e) {
            Log::error('采集详情失败: ' . $e->getMessage());
            return ['code' => 1, 'msg' => '采集失败'];
        }
    }

    /**
     * 导入采集的视频到本地数据库
     * @param array $videoData 视频数据
     * @return bool
     */
    public static function importVideo($videoData)
    {
        try {
            // 这里需要根据实际情况实现视频数据的导入逻辑
            // 包括图片下载、视频转码等
            return true;
        } catch (\Exception $e) {
            Log::error('导入视频失败: ' . $e->getMessage());
            return false;
        }
    }
}
