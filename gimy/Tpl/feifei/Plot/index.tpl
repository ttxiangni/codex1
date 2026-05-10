<include file="BlockTheme:header" />
<div class="container">
    <div class="plot-page">
        <h1>剧情题材</h1>
        <div class="plot-cloud">
            {plotlist:vod num="50" order="plot_hits desc"}
            <a href="{field:url}" class="plot-tag" style="font-size: {field:hits|plot_size}px;">{field:name}</a>
            {/plotlist:vod}
        </div>
    </div>
</div>
<include file="BlockTheme:footer" />