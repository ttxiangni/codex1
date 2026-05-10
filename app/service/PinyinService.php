<?php

namespace app\service;

/**
 * Pinyin service for converting Chinese to pinyin for SEO-friendly URLs
 */
class PinyinService
{
    // Simplified pinyin mapping for common Chinese characters
    protected static $pinyinMap = [
        '中' => 'zhong', '国' => 'guo', '美' => 'mei', '法' => 'fa', 
        '英' => 'ying', '日' => 'ri', '韩' => 'han', '泰' => 'tai',
        '印' => 'yin', '度' => 'du', '越' => 'yue', '南' => 'nan',
        '大' => 'da', '小' => 'xiao', '新' => 'xin', '老' => 'lao',
        '男' => 'nan', '女' => 'nv', '纪' => 'ji', '录' => 'lu',
        '爱' => 'ai', '情' => 'qing', '喜' => 'xi', '剧' => 'ju',
        '电' => 'dian', '影' => 'ying', '视' => 'shi', '频' => 'pin',
        '动' => 'dong', '作' => 'zuo', '画' => 'hua', '恐' => 'kong',
        '怖' => 'bu', '冒' => 'mao', '险' => 'xian', '悬' => 'xuan',
        '疑' => 'yi', '科' => 'ke', '幻' => 'huan', '奇' => 'qi',
        '幽' => 'you', '默' => 'mo', '音' => 'yin', '乐' => 'le',
        '歌' => 'ge', '舞' => 'wu', '剧' => 'ju', '综' => 'zong',
        '艺' => 'yi', '体' => 'ti', '育' => 'yu', '足' => 'zu',
        '篮' => 'lan', '乒' => 'ping', '羽' => 'yu', '毛' => 'mao',
        '网' => 'wang', '球' => 'qiu', '赛' => 'sai', '主' => 'zhu',
        '播' => 'bo', '讲' => 'jiang', '座' => 'zuo', '谈' => 'tan',
        '话' => 'hua', '节' => 'jie', '目' => 'mu', '特' => 'te',
        '别' => 'bie', '真' => 'zhen', '人' => 'ren', '秀' => 'xiu',
    ];

    /**
     * Convert Chinese text to pinyin (首字母)
     * Returns the first letter of each character's pinyin
     */
    public static function getPinyinAbbr($text)
    {
        $text = trim($text);
        if (empty($text)) {
            return '';
        }

        $abbr = '';
        $len = strlen($text);
        for ($i = 0; $i < $len; $i++) {
            $char = $text[$i];
            if (isset(self::$pinyinMap[$char])) {
                $abbr .= strtoupper(substr(self::$pinyinMap[$char], 0, 1));
            } elseif (ctype_alpha($char)) {
                $abbr .= strtoupper($char);
            }
        }
        return $abbr;
    }

    /**
     * Convert Chinese text to full pinyin
     */
    public static function getPinyinFull($text)
    {
        $text = trim($text);
        if (empty($text)) {
            return '';
        }

        $pinyin = '';
        $len = strlen($text);
        for ($i = 0; $i < $len; $i++) {
            $char = $text[$i];
            if (isset(self::$pinyinMap[$char])) {
                $pinyin .= self::$pinyinMap[$char];
            } elseif (ctype_alnum($char)) {
                $pinyin .= strtolower($char);
            }
        }
        return $pinyin;
    }

    /**
     * Get pinyin slug for URL (simplified + transliteration)
     */
    public static function getSlug($text)
    {
        $text = trim($text);
        if (empty($text)) {
            return '';
        }

        // Get first letter of each character
        $slug = '';
        $len = strlen($text);
        for ($i = 0; $i < $len; $i++) {
            $char = $text[$i];
            if (isset(self::$pinyinMap[$char])) {
                $slug .= strtolower(substr(self::$pinyinMap[$char], 0, 1));
            } elseif (ctype_alnum($char)) {
                $slug .= strtolower($char);
            }
        }
        
        // Clean up
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
        $slug = trim($slug, '-');
        
        return $slug;
    }
}
