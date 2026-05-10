# FeiFei CMS 标签使用说明

本文档详细介绍 FeiFei CMS 中所有可用的模板标签及其使用方法。这些标签基于 feifeicms4.3 的标签系统，支持内容展示、循环、条件判断等功能。

## 目录

1. [视频相关标签](#视频相关标签)
2. [文章相关标签](#文章相关标签)
3. [演员相关标签](#演员相关标签)
4. [分集相关标签](#分集相关标签)
5. [分类相关标签](#分类相关标签)
6. [SEO相关标签](#seo相关标签)
7. [系统标签](#系统标签)
8. [循环和条件标签](#循环和条件标签)

## 视频相关标签

### {feifei:video name="字段名" /}
获取当前视频页面的字段值。

**可用字段：**
- `id` - 视频ID
- `name` - 视频名称
- `pic` - 封面图片
- `actor` - 主演
- `director` - 导演
- `writer` - 编剧
- `year` - 年份
- `area` - 地区
- `lang` - 语言
- `content` - 简介
- `score` - 评分
- `hits` - 点击量
- `create_time` - 创建时间
- `update_time` - 更新时间

**示例：**
```html
<h1>{feifei:video name="name" /}</h1>
<img src="{feifei:video name="pic" /}" alt="{feifei:video name="name" /}">
<p>导演：{feifei:video name="director" /}</p>
```

### {feifei:video_list ...}
循环显示视频列表。

**参数：**
- `cid` - 分类ID
- `limit` - 显示数量
- `order` - 排序方式 (如: `hits desc`, `create_time desc`)
- `where` - 条件筛选

**示例：**
```html
{feifei:video_list cid="1" limit="10" order="hits desc"}
<div class="video-item">
    <img src="{feifei:video name="pic" /}" alt="{feifei:video name="name" /}">
    <h3><a href="{feifei:video_link id="$id" /}">{feifei:video name="name" /}</a></h3>
    <p>{feifei:video name="actor" /}</p>
</div>
{/feifei:video_list}
```

### {feifei:video_link id="视频ID" /}
生成视频详情页链接。

### {feifei:video_category_link id="分类ID" /}
生成视频分类页链接。

## 文章相关标签

### {feifei:article name="字段名" /}
获取当前文章页面的字段值。

**可用字段：**
- `id` - 文章ID
- `title` - 标题
- `content` - 内容
- `author` - 作者
- `thumbnail` - 缩略图
- `description` - 描述
- `keywords` - 关键词
- `category_id` - 分类ID
- `category_name` - 分类名称
- `views` - 浏览量
- `create_time` - 创建时间

**示例：**
```html
<h1>{feifei:article name="title" /}</h1>
<p>作者：{feifei:article name="author" /}</p>
<div>{feifei:article name="content" /}</div>
```

### {feifei:article_list ...}
循环显示文章列表。

**参数：**
- `cid` - 分类ID
- `limit` - 显示数量
- `order` - 排序方式

**示例：**
```html
{feifei:article_list cid="1" limit="5" order="create_time desc"}
<div class="article-item">
    <h4><a href="{feifei:article_link id="$id" /}">{feifei:article name="title" /}</a></h4>
    <p>{feifei:article name="description" /}</p>
</div>
{/feifei:article_list}
```

### {feifei:article_link id="文章ID" /}
生成文章详情页链接。

### {feifei:article_category_link id="分类ID" /}
生成文章分类页链接。

### {feifei:article_category_list}
循环显示文章分类。

## 演员相关标签

### {feifei:actor name="字段名" /}
获取当前演员页面的字段值。

**可用字段：**
- `id` - 演员ID
- `name` - 姓名
- `english_name` - 英文名
- `avatar` - 头像
- `gender` - 性别
- `birthday` - 生日
- `height` - 身高
- `weight` - 体重
- `constellation` - 星座
- `blood_type` - 血型
- `region` - 地区
- `biography` - 简介
- `views` - 浏览量
- `video_count` - 参演作品数量

**示例：**
```html
<h1>{feifei:actor name="name" /}</h1>
<img src="{feifei:actor name="avatar" /}" alt="{feifei:actor name="name" /}">
<p>生日：{feifei:actor name="birthday" /}</p>
```

### {feifei:actor_list ...}
循环显示演员列表。

**参数：**
- `region` - 地区筛选
- `gender` - 性别筛选
- `limit` - 显示数量
- `order` - 排序方式

**示例：**
```html
{feifei:actor_list region="中国" limit="12" order="views desc"}
<div class="actor-item">
    <img src="{feifei:actor name="avatar" /}" alt="{feifei:actor name="name" /}">
    <h5><a href="{feifei:actor_link id="$id" /}">{feifei:actor name="name" /}</a></h5>
</div>
{/feifei:actor_list}
```

### {feifei:actor_link id="演员ID" /}
生成演员详情页链接。

### {feifei:actor_videos ...}
显示演员参演的视频。

**参数：**
- `limit` - 显示数量

### {feifei:actor_region_list}
循环显示演员地区。

## 分集相关标签

### {feifei:episode name="字段名" /}
获取当前分集页面的字段值。

**可用字段：**
- `id` - 分集ID
- `title` - 标题
- `episode_number` - 集数
- `plot` - 剧情简介
- `director` - 导演
- `writer` - 编剧
- `actors` - 主演
- `duration` - 时长
- `air_date` - 上映日期
- `play_url` - 播放地址
- `video_id` - 所属视频ID
- `status` - 状态

**示例：**
```html
<h1>{feifei:episode name="title" /}</h1>
<p>第{feifei:episode name="episode_number" /}集</p>
<div>{feifei:episode name="plot" /}</div>
```

### {feifei:episode_list ...}
循环显示分集列表。

**参数：**
- `video_id` - 视频ID
- `limit` - 显示数量
- `order` - 排序方式

**示例：**
```html
{feifei:episode_list video_id="1" limit="20" order="episode_number asc"}
<div class="episode-item">
    <a href="{feifei:episode_link id="$id" /}">第{feifei:episode name="episode_number" /}集</a>
</div>
{/feifei:episode_list}
```

### {feifei:episode_link id="分集ID" /}
生成分集详情页链接。

### {feifei:episode_player /}
生成分集播放器。

## 分类相关标签

### {feifei:category name="字段名" /}
获取当前分类的字段值。

**可用字段：**
- `id` - 分类ID
- `name` - 分类名称
- `pid` - 父级分类ID
- `sort` - 排序

### {feifei:video_category_list}
循环显示视频分类。

### {feifei:article_category_list}
循环显示文章分类。

## SEO相关标签

### {feifei:seo name="字段名" /}
获取当前页面的SEO信息。

**可用字段：**
- `title` - 页面标题
- `description` - 页面描述
- `keywords` - 关键词
- `author` - 作者
- `image` - 图片
- `url` - 页面URL

**示例：**
```html
<title>{feifei:seo name="title" /}</title>
<meta name="description" content="{feifei:seo name="description" /}">
```

## 系统标签

### {feifei:global name="变量名" /}
获取全局配置变量。

**常用变量：**
- `site_name` - 网站名称
- `site_url` - 网站URL
- `site_description` - 网站描述
- `site_keywords` - 网站关键词

### {feifei:now format="格式" /}
显示当前时间。

**参数：**
- `format` - 时间格式 (如: `Y-m-d H:i:s`)

**示例：**
```html
<p>当前时间：{feifei:now format="Y-m-d H:i:s" /}</p>
```

### {feifei:count table="表名" where="条件" /}
统计数据数量。

**参数：**
- `table` - 数据表名
- `where` - 查询条件

**示例：**
```html
<p>视频总数：{feifei:count table="video" /}</p>
```

## 循环和条件标签

### 条件判断
```html
{if $variable == 'value'}
    <!-- 条件为真时显示的内容 -->
{else}
    <!-- 条件为假时显示的内容 -->
{/if}
```

### 循环
```html
{foreach $array as $item}
    <!-- 循环内容 -->
{/foreach}
```

### 分页
```html
{feifei:video_pagination /}
{feifei:article_pagination /}
{feifei:actor_pagination /}
```

## 高级用法

### 嵌套标签
标签支持嵌套使用，可以在循环中使用其他标签：

```html
{feifei:video_list limit="5"}
    <div class="video-item">
        <h3>{feifei:video name="name" /}</h3>
        <p>分类：{feifei:category name="name" /}</p>
        <p>主演：{feifei:video name="actor" /}</p>
    </div>
{/feifei:video_list}
```

### 变量传递
在循环中，可以使用 `$变量名` 传递参数：

```html
{feifei:video_list cid="$category_id" limit="10"}
    <!-- 这里可以使用 $id, $name 等变量 -->
{/feifei:video_list}
```

### 缓存标签
部分标签支持缓存，提高性能：

```html
{feifei:video_list limit="20" cache="3600"}
    <!-- 此循环结果将被缓存3600秒 -->
{/feifei:video_list}
```

## 注意事项

1. 所有标签都需要在模板文件中使用，不能在PHP代码中使用。
2. 标签参数使用双引号包围，多个参数用空格分隔。
3. 循环标签必须有对应的结束标签。
4. SEO标签需要在页面头部使用。
5. 建议在生产环境中启用缓存以提高性能。

## 自定义标签

如果需要自定义标签，可以在 `app/service/TagService.php` 中添加新的标签处理逻辑。