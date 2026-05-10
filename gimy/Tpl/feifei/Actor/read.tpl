<include file="BlockTheme:header" />
<div class="container">
    <div class="actor-detail">
        <div class="actor-header">
            <img src="{actor:detail}{field:pic}{/actor:detail}" alt="{actor:detail}{field:name}{/actor:detail}">
            <div class="actor-info">
                <h1>{actor:detail}{field:name}{/actor:detail}</h1>
                <p>生日：{actor:detail}{field:birthday}{/actor:detail}</p>
                <p>身高：{actor:detail}{field:height}{/actor:detail}</p>
                <p>简介：{actor:detail}{field:content}{/actor:detail}</p>
            </div>
        </div>
        
        <div class="actor-works">
            <h2>代表作品</h2>
            <div class="grid">
                {vodlist:vod actor="{actor:name}" num="24"}
                <include file="BlockTheme:item_img_vod" />
                {/vodlist:vod}
            </div>
        </div>
    </div>
</div>
<include file="BlockTheme:footer" />