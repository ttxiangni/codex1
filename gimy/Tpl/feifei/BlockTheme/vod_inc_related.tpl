<section class="related-vod">
    <h3>相关推荐</h3>
    <div class="grid">
        {vodlist:vod actor="{vod:actor}" order="vod_hits desc" num="12" notid="{vod:id}"}
        <include file="BlockTheme:item_img_vod" />
        {/vodlist:vod}
    </div>
</section>