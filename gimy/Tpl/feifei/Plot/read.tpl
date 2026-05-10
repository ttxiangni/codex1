<include file="BlockTheme:header" />
<div class="container">
    <div class="plot-detail">
        <h1>{plot:detail}{field:name}{/plot:detail}</h1>
        <p>{plot:detail}{field:content}{/plot:detail}</p>
        
        <div class="plot-vods">
            <h2>相关影片</h2>
            <div class="grid">
                {vodlist:vod plot="{plot:name}" num="24"}
                <include file="BlockTheme:item_img_vod" />
                {/vodlist:vod}
            </div>
        </div>
    </div>
</div>
<include file="BlockTheme:footer" />