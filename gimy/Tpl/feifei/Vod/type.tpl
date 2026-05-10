<include file="BlockTheme:header" />
<div class="container">
    <div class="list-page">
        <h1>{type:detail}{field:name}{/type:detail}</h1>
        <div class="grid">
            {vodlist:vod type="{type:id}" num="24"}
            <include file="BlockTheme:item_img_vod" />
            {/vodlist:vod}
        </div>
    </div>
</div>
<include file="BlockTheme:footer" />