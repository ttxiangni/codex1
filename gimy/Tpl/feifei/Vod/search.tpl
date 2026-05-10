<include file="BlockTheme:header" />
<div class="container">
    <div class="search-page">
        <h1>搜索结果：{$wd}</h1>
        <div class="grid">
            {vodlist:vod wd="{$wd}" num="24"}
            <include file="BlockTheme:item_img_vod" />
            {/vodlist:vod}
        </div>
    </div>
</div>
<include file="BlockTheme:footer" />