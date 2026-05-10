<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get('think', function () {
    return 'hello,ThinkPHP8!';
});

Route::get('hello/:name', 'index/hello');

// 前台路由
Route::get('/', 'index/index');
Route::get('category/:slug', 'index/category');
Route::get('video/:slug', 'index/video');
Route::get('play/:id', 'index/play');
Route::get('search', 'index/search');

// 文章路由
Route::get('article/:id', 'article/detail');
Route::get('article/category/:id', 'article/category');
Route::get('articles', 'article/index');

// 演员路由
Route::get('actor/:slug', 'actor/detail');
Route::get('actors', 'actor/index');

// 分集路由
Route::get('episode/:id', 'index/episode');

// 采集路由
Route::get('spider', 'spider/index');
Route::post('spider/collect', 'spider/collect');

// SEO路由
Route::get('seo', 'seo/index');

// Sitemap路由
Route::get('sitemap.xml', 'sitemap/xml');
Route::get('sitemap', 'sitemap/index');
Route::get('robots.txt', 'sitemap/robots');

// 后台路由
Route::get('admin', 'admin/index');
Route::get('admin/video', 'admin/video');
Route::get('admin/video/add', 'admin/videoAdd');
Route::post('admin/video/add', 'admin/videoAdd');
Route::get('admin/video/edit/:id', 'admin/videoEdit');
Route::post('admin/video/edit/:id', 'admin/videoEdit');
Route::get('admin/video/delete/:id', 'admin/videoDelete');

Route::get('admin/category', 'admin/category');
Route::get('admin/category/add', 'admin/categoryAdd');
Route::post('admin/category/add', 'admin/categoryAdd');
Route::get('admin/category/edit/:id', 'admin/categoryEdit');
Route::post('admin/category/edit/:id', 'admin/categoryEdit');
Route::get('admin/category/delete/:id', 'admin/categoryDelete');

Route::get('admin/user', 'admin/user');
Route::get('admin/comment', 'admin/comment');

// 后台文章管理
Route::get('admin/article', 'admin/article');
Route::get('admin/article/add', 'admin/articleAdd');
Route::post('admin/article/add', 'admin/articleAdd');
Route::get('admin/article/edit/:id', 'admin/articleEdit');
Route::post('admin/article/edit/:id', 'admin/articleEdit');
Route::get('admin/article/delete/:id', 'admin/articleDelete');
Route::get('admin/article/category', 'admin/articleCategory');
Route::get('admin/article/category/add', 'admin/articleCategoryAdd');
Route::post('admin/article/category/add', 'admin/articleCategoryAdd');
Route::get('admin/article/category/edit/:id', 'admin/articleCategoryEdit');
Route::post('admin/article/category/edit/:id', 'admin/articleCategoryEdit');
Route::get('admin/article/category/delete/:id', 'admin/articleCategoryDelete');

// 后台演员管理
Route::get('admin/actor', 'admin/actor');
Route::get('admin/actor/add', 'admin/actorAdd');
Route::post('admin/actor/add', 'admin/actorAdd');
Route::get('admin/actor/edit/:id', 'admin/actorEdit');
Route::post('admin/actor/edit/:id', 'admin/actorEdit');
Route::get('admin/actor/delete/:id', 'admin/actorDelete');

// 后台分集管理
Route::get('admin/episode', 'admin/episode');
Route::get('admin/episode/add', 'admin/episodeAdd');
Route::post('admin/episode/add', 'admin/episodeAdd');
Route::get('admin/episode/edit/:id', 'admin/episodeEdit');
Route::post('admin/episode/edit/:id', 'admin/episodeEdit');
Route::get('admin/episode/delete/:id', 'admin/episodeDelete');

// 后台采集管理
Route::get('admin/spider', 'admin/spider');
Route::get('admin/spider/add', 'admin/spiderAdd');
Route::post('admin/spider/add', 'admin/spiderAdd');
Route::get('admin/spider/edit/:id', 'admin/spiderEdit');
Route::post('admin/spider/edit/:id', 'admin/spiderEdit');
Route::get('admin/spider/delete/:id', 'admin/spiderDelete');
Route::post('admin/spider/collect/:id', 'admin/spiderCollect');

// 后台SEO管理
Route::get('admin/seo', 'admin/seo');
Route::get('admin/seo/add', 'admin/seoAdd');
Route::post('admin/seo/add', 'admin/seoAdd');
Route::get('admin/seo/edit/:id', 'admin/seoEdit');
Route::post('admin/seo/edit/:id', 'admin/seoEdit');
Route::get('admin/seo/delete/:id', 'admin/seoDelete');

// 后台缓存管理
Route::get('admin/cache', 'admin/cache');
Route::post('admin/cache/clear', 'admin/cacheClear');

// 后台系统设置
Route::get('admin/setting', 'admin/setting');
Route::post('admin/setting/save', 'admin/settingSave');

// 用户中心路由
Route::get('user', 'user/index');
Route::get('user/favorites', 'user/favorites');
Route::get('user/history', 'user/history');
Route::get('user/messages', 'user/messages');

// API路由
Route::get('api/videos', 'api/videos');
Route::get('api/video/:id', 'api/video');
Route::get('api/categories', 'api/categories');
Route::post('api/addComment', 'api/addComment');
Route::get('api/getComments/:videoId', 'api/getComments');
Route::post('api/toggleFavorite', 'api/toggleFavorite');
Route::get('api/checkFavorite', 'api/checkFavorite');
Route::get('api/getFavorites/:userId', 'api/getFavorites');
Route::post('api/addWatchHistory', 'api/addWatchHistory');
Route::get('api/getWatchHistory/:userId', 'api/getWatchHistory');
Route::get('api/getMessages/:userId', 'api/getMessages');
Route::post('api/markMessageRead/:messageId', 'api/markMessageRead');
Route::get('api/getUnreadMessageCount/:userId', 'api/getUnreadMessageCount');
Route::get('api/search', 'api/search');
