# FeiFei CMS - 综合视频内容管理系统

基于ThinkPHP 8框架开发的现代化视频CMS系统，兼容MacCMS10数据格式，支持百万级数据处理。

## 🚀 核心功能

### 📺 视频内容管理
- **视频管理**：支持电影、电视剧、综艺、动漫等多种类型
- **演员角色系统**：兼容MacCMS10格式的多演员角色管理
- **剧集管理**：详细的剧集剧情、导演、编剧信息
- **分类管理**：灵活的多级分类体系

### 📰 文章资讯系统
- **文章发布**：支持富文本编辑和图片上传
- **分类管理**：文章分类和标签系统
- **SEO优化**：页面级别的SEO配置管理

### 🤖 智能采集系统
- **Spider采集**：兼容MacCMS10的智能采集模块
- **规则配置**：灵活的采集规则设置
- **自动分类**：智能内容分类和标签

### ⚡ 性能优化
- **Redis缓存**：页面缓存和数据循环缓存
- **数据库分区**：支持百万级数据的分区存储
- **CDN优化**：静态资源优化和分发

### 🎨 用户体验
- **响应式设计**：Bootstrap 5 + Font Awesome 6
- **夜间模式**：用户可切换的深色主题
- **移动端适配**：完美支持移动设备

### 🔧 管理后台
- **可视化管理**：参考feifeicms4.3的管理界面
- **权限控制**：管理员角色权限管理
- **数据统计**：访问量、用户行为分析

## 📋 系统要求

- **PHP** >= 8.0
- **MySQL** >= 5.7 (支持分区表)
- **Redis** >= 4.0 (可选，用于缓存)
- **Composer** (PHP包管理)

## 🛠️ 快速安装

### 1. 环境准备
```bash
# 克隆项目
git clone https://github.com/ttxiangni/codex1.git
cd codex1

# 安装依赖
composer install

# 设置权限
chmod -R 755 runtime/
chmod -R 755 public/
```

### 2. 数据库配置
```bash
# 创建数据库
mysql -u root -p
CREATE DATABASE feifei_cms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# 导入数据结构
mysql -u root -p feifei_cms < database/database.sql
```

### 3. 配置文件
```bash
# 复制环境配置
cp .example.env .env

# 编辑配置
vim .env
```

### 4. 运行安装
```bash
# 访问安装页面
# http://your-domain/install.php

# 或命令行安装
php think install
```

## 📁 项目结构

```
feifei-cms/
├── app/                    # 应用目录
│   ├── controller/         # 控制器
│   │   ├── Article.php     # 文章控制器
│   │   ├── Actor.php       # 演员控制器
│   │   ├── Video.php       # 视频控制器
│   │   └── Admin/          # 后台管理控制器
│   ├── model/              # 数据模型
│   │   ├── Article.php     # 文章模型
│   │   ├── Actor.php       # 演员模型
│   │   ├── Video.php       # 视频模型
│   │   └── Spider.php      # 采集模型
│   ├── service/            # 服务层
│   │   ├── CacheService.php    # 缓存服务
│   │   ├── SeoService.php      # SEO服务
│   │   └── SpiderService.php   # 采集服务
│   └── view/               # 模板文件
├── config/                 # 配置文件
├── database/               # 数据库文件
│   ├── database.sql        # 数据库结构
│   └── seeds/              # 数据种子
├── public/                 # 公共资源
│   ├── static/             # 静态文件
│   ├── upload/             # 上传文件
│   └── demo/               # 演示页面
├── route/                  # 路由配置
├── runtime/                # 运行时目录
├── vendor/                 # Composer包
├── think                   # ThinkPHP命令行
├── install.php             # 安装脚本
└── README.md               # 说明文档
```

## 🎯 API接口文档

### 视频接口
```http
GET    /api/videos              # 获取视频列表
GET    /api/video/{id}          # 获取视频详情
GET    /api/categories          # 获取分类列表
POST   /api/video/play/{id}     # 播放统计
```

### 文章接口
```http
GET    /api/articles            # 获取文章列表
GET    /api/article/{id}        # 获取文章详情
GET    /api/article/categories  # 获取文章分类
```

### 演员接口
```http
GET    /api/actors              # 获取演员列表
GET    /api/actor/{id}          # 获取演员详情
GET    /api/actor/roles/{id}    # 获取演员角色
```

### 采集接口
```http
GET    /api/spider/rules        # 获取采集规则
POST   /api/spider/run          # 执行采集任务
GET    /api/spider/logs         # 获取采集日志
```

## 🎨 前端模板标签

系统使用feifeicms4.3兼容的模板标签：

### 视频标签
```html
{video:list limit="10" order="hits desc"}
  <li><a href="{field:url}">{field:title}</a></li>
{/video:list}

{video:detail id="$id"}
  <h1>{field:title}</h1>
  <p>{field:content}</p>
{/video:detail}
```

### 演员标签
```html
{actor:list limit="12"}
  <div class="actor-item">
    <img src="{field:pic}" alt="{field:name}">
    <h3>{field:name}</h3>
  </div>
{/actor:list}
```

### 文章标签
```html
{article:list cid="$cid" limit="10"}
  <article>
    <h2><a href="{field:url}">{field:title}</a></h2>
    <p>{field:description}</p>
  </article>
{/article:list}
```

## 🔧 后台管理

访问 `/admin` 进入管理后台：

### 主要功能模块
- **内容管理**：视频、文章、演员管理
- **分类管理**：多级分类体系
- **采集管理**：Spider规则配置
- **SEO管理**：页面SEO配置
- **缓存管理**：缓存清理和配置
- **系统设置**：基础配置管理

### 权限管理
- 超级管理员：全部权限
- 内容管理员：内容相关权限
- 编辑员：编辑权限

## 📊 性能优化

### 数据库优化
- **分区表**：支持千万级数据存储
- **索引优化**：复合索引和全文索引
- **查询优化**：JOIN优化和子查询优化

### 缓存策略
- **页面缓存**：整页缓存，TTL自定义
- **数据缓存**：热点数据缓存
- **CDN集成**：静态资源分发

### 监控指标
- **QPS监控**：请求量监控
- **响应时间**：页面响应时间统计
- **缓存命中率**：缓存效果监控

## 🌟 演示页面

系统提供了完整的演示页面：

- `public/demo/index.html` - 首页演示
- `public/demo/video.html` - 视频详情页演示
- `public/demo/article.html` - 文章详情页演示
- `public/demo/actor.html` - 演员详情页演示

## 📖 使用文档

### 模板标签使用指南
详见 `TAG_GUIDE.md` 文件

### API开发文档
详见 `API_DOC.md` 文件

### 部署指南
详见 `DEPLOY.md` 文件

## 🤝 贡献指南

1. Fork 项目
2. 创建特性分支 (`git checkout -b feature/AmazingFeature`)
3. 提交更改 (`git commit -m 'Add some AmazingFeature'`)
4. 推送到分支 (`git push origin feature/AmazingFeature`)
5. 创建 Pull Request

## 📄 开源协议

本项目采用 MIT 协议开源 - 查看 [LICENSE](LICENSE) 文件了解详情

## 🆘 技术支持

- **文档**：https://docs.feifei-cms.com
- **社区**：https://forum.feifei-cms.com
- **Issues**：https://github.com/feifei-cms/issues

## 🙏 致谢

感谢以下开源项目：
- [ThinkPHP](https://www.thinkphp.cn/) - PHP框架
- [Bootstrap](https://getbootstrap.com/) - CSS框架
- [Font Awesome](https://fontawesome.com/) - 图标库
- [Redis](https://redis.io/) - 缓存数据库

---

**FeiFei CMS** - 让视频内容管理更简单！

## 文档

[完全开发手册](https://doc.thinkphp.cn)


## 赞助

全新的[赞助计划](https://www.thinkphp.cn/sponsor)可以让你通过我们的网站、手册、欢迎页及GIT仓库获得巨大曝光，同时提升企业的品牌声誉，也更好保障ThinkPHP的可持续发展。

[![](https://www.thinkphp.cn/sponsor/special.svg)](https://www.thinkphp.cn/sponsor/special)

[![](https://www.thinkphp.cn/sponsor.svg)](https://www.thinkphp.cn/sponsor)

## 安装

~~~
composer create-project topthink/think tp
~~~

启动服务

~~~
cd tp
php think run
~~~

然后就可以在浏览器中访问

~~~
http://localhost:8000
~~~

如果需要更新框架使用
~~~
composer update topthink/framework
~~~

## 命名规范

`ThinkPHP`遵循PSR-2命名规范和PSR-4自动加载规范。

## 参与开发

直接提交PR或者Issue即可

## 版权信息

ThinkPHP遵循Apache2开源协议发布，并提供免费使用。

本项目包含的第三方源码和二进制文件之版权信息另行标注。

版权所有Copyright © 2006-2024 by ThinkPHP (http://thinkphp.cn) All rights reserved。

ThinkPHP® 商标和著作权所有者为上海顶想信息科技有限公司。

更多细节参阅 [LICENSE.txt](LICENSE.txt)
