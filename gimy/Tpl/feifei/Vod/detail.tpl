<include file="BlockTheme:header" />
<div class="container">
    <div class="detail-page">
        <div class="detail-header">
            <div class="detail-poster">
                <img src="{vod:detail}{field:pic}{/vod:detail}" alt="{vod:detail}{field:name}{/vod:detail}">
            </div>
            <div class="detail-info">
                <h1>{vod:detail}{field:name}{/vod:detail}</h1>
                <p>导演：{vod:detail}{field:director}{/vod:detail}</p>
                <p>主演：{vod:detail}{field:actor}{/vod:detail}</p>
                <p>类型：{vod:detail}{field:type}{/vod:detail}</p>
                <p>地区：{vod:detail}{field:area}{/vod:detail}</p>
                <p>年份：{vod:detail}{field:year}{/vod:detail}</p>
                <p>评分：{vod:detail}{field:score}{/vod:detail}</p>
                <div class="detail-desc">
                    <h3>剧情简介</h3>
                    <p>{vod:detail}{field:content}{/vod:detail}</p>
                </div>
                <div class="detail-actions">
                    <a href="{vod:detail}{field:playurl}{/vod:detail}" class="btn btn-primary">立即播放</a>
                    <button class="btn btn-secondary" onclick="addToFavorites()">收藏</button>
                </div>
            </div>
        </div>

        <include file="BlockTheme:vod_inc_hot" />
        <include file="BlockTheme:vod_inc_related" />
        <include file="BlockTheme:forum_inc_vod" />
    </div>
</div>
<include file="BlockTheme:footer" />