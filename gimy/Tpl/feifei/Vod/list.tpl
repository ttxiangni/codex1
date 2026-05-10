<include file="BlockTheme:header" />
<div class="container">
    <div class="list-page">
        <div class="list-header">
            <h1>{type:detail}{field:name}{/type:detail}</h1>
            <div class="filter-bar">
                <select name="order">
                    <option value="vod_hits">按热度</option>
                    <option value="vod_addtime">按时间</option>
                    <option value="vod_score">按评分</option>
                </select>
            </div>
        </div>

        <div class="grid">
            {vodlist:vod type="{type:id}" order="vod_hits desc" num="24"}
            <include file="BlockTheme:item_img_vod" />
            {/vodlist:vod}
        </div>

        <div class="pagination">
            {page:vod num="10" type="{type:id}"}
            <a href="{field:url}">{field:page}</a>
            {/page:vod}
        </div>
    </div>
</div>
<include file="BlockTheme:footer" />