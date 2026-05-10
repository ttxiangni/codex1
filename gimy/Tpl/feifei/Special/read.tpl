<include file="BlockTheme:header" />
<div class="container">
    <div class="special-detail">
        <div class="special-header">
            <img src="{topic:detail}{field:pic}{/topic:detail}" alt="{topic:detail}{field:name}{/topic:detail}">
            <div class="special-info">
                <h1>{topic:detail}{field:name}{/topic:detail}</h1>
                <p>{topic:detail}{field:content}{/topic:detail}</p>
            </div>
        </div>
        
        <div class="special-vods">
            <h2>专题影片</h2>
            <div class="grid">
                {vodlist:vod topic_id="{topic:id}" num="24"}
                <include file="BlockTheme:item_img_vod" />
                {/vodlist:vod}
            </div>
        </div>
    </div>
</div>
<include file="BlockTheme:footer" />