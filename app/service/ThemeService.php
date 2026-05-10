<?php
namespace app\service;

use think\facade\Cookie;

class ThemeService
{
    const LIGHT_THEME = 'light';
    const DARK_THEME = 'dark';
    const COOKIE_NAME = 'app_theme';
    const COOKIE_EXPIRE = 3600 * 24 * 365;  // 保存一年

    /**
     * 获取当前主题
     * @return string
     */
    public static function getTheme()
    {
        // 优先从Cookie获取用户设置
        $theme = Cookie::get(self::COOKIE_NAME);
        
        if ($theme && in_array($theme, [self::LIGHT_THEME, self::DARK_THEME])) {
            return $theme;
        }

        // 默认亮色
        return self::LIGHT_THEME;
    }

    /**
     * 切换主题
     * @param string $theme 主题名称
     * @return bool
     */
    public static function setTheme($theme)
    {
        if (!in_array($theme, [self::LIGHT_THEME, self::DARK_THEME])) {
            return false;
        }

        Cookie::set(self::COOKIE_NAME, $theme, self::COOKIE_EXPIRE);
        return true;
    }

    /**
     * 生成主题样式
     * @return string
     */
    public static function renderThemeCSS()
    {
        $theme = self::getTheme();

        if ($theme === self::DARK_THEME) {
            return <<<CSS
<style>
    :root {
        --bs-body-bg: #1a1a1a;
        --bs-body-color: #e4e4e4;
        --bs-border-color: #333;
        --bs-secondary-bg: #2a2a2a;
    }
    
    body {
        background-color: #1a1a1a;
        color: #e4e4e4;
    }

    .card {
        background-color: #2a2a2a;
        border-color: #333;
    }

    .navbar {
        background-color: #1a1a1a !important;
        border-bottom: 1px solid #333;
    }

    .form-control, .form-select {
        background-color: #2a2a2a;
        border-color: #333;
        color: #e4e4e4;
    }

    .form-control:focus, .form-select:focus {
        background-color: #2a2a2a;
        border-color: #666;
        color: #e4e4e4;
    }

    footer {
        background-color: #1a1a1a;
        border-top: 1px solid #333;
    }

    .text-muted {
        color: #999 !important;
    }

    a {
        color: #66a3ff;
    }

    a:hover {
        color: #99bbff;
    }

    .btn-outline-light {
        color: #e4e4e4;
        border-color: #e4e4e4;
    }

    .btn-outline-light:hover {
        background-color: #e4e4e4;
        color: #1a1a1a;
    }

    .table {
        color: #e4e4e4;
        border-color: #333;
    }

    .list-group-item {
        background-color: #2a2a2a;
        border-color: #333;
        color: #e4e4e4;
    }

    .list-group-item.active {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
</style>
CSS;
        }

        return '';
    }

    /**
     * 生成黑夜模式切换脚本
     * @return string
     */
    public static function renderThemeToggleScript()
    {
        return <<<JS
<script>
    function toggleTheme() {
        const currentTheme = document.cookie
            .split('; ')
            .find(row => row.startsWith('app_theme='))
            ?.split('=')[1] || 'light';

        const newTheme = currentTheme === 'light' ? 'dark' : 'light';

        // 保存主题设置
        fetch('/api/setTheme', {
            method: 'POST',
            body: JSON.stringify({ theme: newTheme }),
            headers: { 'Content-Type': 'application/json' }
        }).then(() => location.reload());
    }

    // 黑夜模式自动切换
    function autoToggleDarkMode() {
        const isDarkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        if (isDarkMode && !document.cookie.includes('app_theme=')) {
            fetch('/api/setTheme', {
                method: 'POST',
                body: JSON.stringify({ theme: 'dark' }),
                headers: { 'Content-Type': 'application/json' }
            });
        }
    }

    // 监听系统主题变更
    if (window.matchMedia) {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
            const newTheme = e.matches ? 'dark' : 'light';
            fetch('/api/setTheme', {
                method: 'POST',
                body: JSON.stringify({ theme: newTheme }),
                headers: { 'Content-Type': 'application/json' }
            }).then(() => location.reload());
        });
    }
</script>
JS;
    }
}
