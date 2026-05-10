<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$site_name} - 影视网站</title>
    <link rel="stylesheet" href="{$public_path}static/css/style.css">
    <script src="{$public_path}static/js/main.js"></script>
</head>
<body>
    <header class="header">
        <nav class="nav">
            <div class="logo">
                <a href="{:ff_url('index/index')}">{$site_name}</a>
            </div>
            <ul class="nav-menu">
                <li><a href="{:ff_url('index/index')}">首页</a></li>
                {typelist:vodtype num="6" order="type_sort desc"}
                <li><a href="{field:url}">{field:name}</a></li>
                {/typelist:vodtype}
            </ul>
            <div class="nav-right">
                <div class="search-box">
                    <form action="{:ff_url('vod/search')}" method="get">
                        <input type="text" name="wd" placeholder="搜索影片...">
                        <button type="submit">搜索</button>
                    </form>
                </div>
                <button class="theme-toggle" onclick="toggleTheme()">🌙</button>
                {if condition="$user_id"}
                <div class="user-menu">
                    <span>{$user_name}</span>
                    <ul class="dropdown">
                        <li><a href="{:ff_url('user/center')}">个人中心</a></li>
                        <li><a href="{:ff_url('user/logout')}">退出</a></li>
                    </ul>
                </div>
                {else}
                <a href="{:ff_url('user/login')}">登录</a>
                <a href="{:ff_url('user/register')}">注册</a>
                {/if}
            </div>
        </nav>
    </header>