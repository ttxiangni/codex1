<include file="BlockTheme:header" />
<div class="container">
    <div class="list-page">
        <h1>影片列表</h1>
        <div class="grid">
            {vodlist:vod num="24"}
            <include file="BlockTheme:item_img_vod" />
            {/vodlist:vod}
        </div>
    </div>
</div>
<include file="BlockTheme:footer" />