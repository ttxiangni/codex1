<include file="BlockTheme:header" />
<div class="container">
    <div class="list-page">
        <h1>最近更新</h1>
        <div class="recent-full">
            {vodlist:vod order="vod_addtime desc" num="50"}
            <include file="BlockTheme:item_txt_vod" />
            {/vodlist:vod}
        </div>
    </div>
</div>
<include file="BlockTheme:footer" />