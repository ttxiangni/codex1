# 影视CMS模板组件说明

## 概述
本项目采用了组件化的模板设计，将重复的UI元素提取为可复用的组件，提高了代码的可维护性和一致性。

## 组件目录结构
```
view/
├── layout/          # 布局模板
│   ├── header.html  # 页面头部（导航栏、CSS引用）
│   └── footer.html  # 页面底部（页脚、JS引用）
└── common/          # 公共组件
    ├── video_card.html      # 视频卡片组件
    ├── empty_state.html     # 空状态组件
    ├── search_form.html     # 搜索表单组件
    ├── pagination.html      # 分页组件
    ├── comment_list.html    # 评论列表组件
    ├── comment_form.html    # 评论表单组件
    ├── breadcrumb.html      # 面包屑导航组件
    ├── category_card.html   # 分类卡片组件
    └── hot_tags.html        # 热门标签组件
```

## 组件使用说明

### 1. video_card.html - 视频卡片组件
用于显示视频列表中的单个视频卡片。

**参数：**
- `$video` - 视频对象，包含title, image, content, create_time, category等属性

**使用示例：**
```html
{include file="common/video_card" /}
```

### 2. empty_state.html - 空状态组件
用于显示没有内容时的空状态提示。

**参数：**
- `icon` - 图标名称（默认：'film'）
- `title` - 标题文本（默认：'暂无内容'）
- `message` - 提示信息（默认：'我们正在努力添加更多精彩内容'）
- `show_search` - 是否显示搜索表单（默认：false）
- `show_home_link` - 是否显示返回首页链接（默认：false）

**使用示例：**
```html
{include file="common/empty_state" title="没有找到相关内容" message="尝试使用其他关键词搜索" show_search=true show_home_link=true /}
```

### 3. search_form.html - 搜索表单组件
用于显示搜索输入框和按钮。

**参数：**
- `form_class` - 表单CSS类名
- `input_class` - 输入框CSS类名
- `placeholder` - 输入框占位符文本
- `keyword` - 默认搜索关键词
- `show_button` - 是否显示搜索按钮（默认：true）
- `button_class` - 按钮CSS类名
- `button_text` - 按钮文本（默认：'搜索'）

**使用示例：**
```html
{include file="common/search_form" form_class="input-group input-group-lg" show_button=true button_text="搜索" /}
```

### 4. pagination.html - 分页组件
用于显示分页导航。

**参数：**
- `pagination` - 分页对象（支持lastPage(), currentPage(), url()等方法）

**使用示例：**
```html
{include file="common/pagination" pagination=$videos /}
```

### 5. comment_list.html - 评论列表组件
用于显示评论列表。

**参数：**
- `comments` - 评论对象集合
- `empty_message` - 空评论时的提示信息

**使用示例：**
```html
{include file="common/comment_list" comments=$comments /}
```

### 6. comment_form.html - 评论表单组件
用于显示发表评论的表单。

**参数：**
- `video_id` - 视频ID
- `title` - 表单标题（默认：'发表评论'）
- `label` - 文本框标签（默认：'评论内容'）
- `placeholder` - 文本框占位符（默认：'写下你的评论...'）
- `button_text` - 提交按钮文本（默认：'发表评论'）

**使用示例：**
```html
{include file="common/comment_form" video_id=$video.id /}
```

### 7. breadcrumb.html - 面包屑导航组件
用于显示页面导航路径。

**参数：**
- `breadcrumbs` - 面包屑数组，每个元素包含title和url

**使用示例：**
```html
{include file="common/breadcrumb" breadcrumbs=[
    ['title'=>'首页', 'url'=>'/'],
    ['title'=>$category.name, 'url'=>'/category/'|cat:$category.id],
    ['title'=>$video.title, 'url'=>'#']
] /}
```

### 8. category_card.html - 分类卡片组件
用于显示分类链接卡片。

**参数：**
- `category` - 分类对象，包含id和name属性
- `icon` - 图标名称（默认：'tag'）

**使用示例：**
```html
{include file="common/category_card" category=$cat /}
```

### 9. hot_tags.html - 热门标签组件
用于显示热门搜索标签。

**参数：**
- `tags` - 标签数组，每个元素包含name属性

**使用示例：**
```html
{include file="common/hot_tags" tags=[
    ['name'=>'动作片'],
    ['name'=>'爱情片'],
    ['name'=>'喜剧片']
] /}
```

## 布局模板

### header.html
页面头部模板，包含：
- HTML头部信息
- Bootstrap CSS
- Font Awesome图标
- 导航栏
- 通用样式

**参数：**
- `title` - 页面标题
- `current_page` - 当前页面标识
- `current_category` - 当前分类ID
- `extra_js` - 额外的JavaScript代码

### footer.html
页面底部模板，包含：
- 页脚信息
- Bootstrap JavaScript
- 通用脚本

## 使用建议

1. **保持组件简单**：每个组件只负责一个功能，避免过度复杂化
2. **参数化设计**：通过参数控制组件的外观和行为
3. **默认值**：为参数提供合理的默认值
4. **一致性**：保持组件间的一致命名和结构
5. **文档更新**：修改组件时及时更新此文档

## 扩展组件

如需添加新的组件，请遵循以下步骤：
1. 在`view/common/`目录下创建组件文件
2. 为组件添加参数支持
3. 在相关页面模板中引用组件
4. 更新此文档说明