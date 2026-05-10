<include file="BlockTheme:header" />
<div class="container">
    <div class="list-page">
        <h1>热播榜</h1>
        <div class="top-list">
            {vodlist:vod order="vod_stars desc,vod_hits desc" num="50"}
            <div class="top-item">
                <span class="rank">{:++$rank}</span>
                <a href="{field:url}">
                    <img src="{field:pic}" alt="{field:name}">
                    <div class="top-info">
                        <h4>{field:name}</h4>
                        <p>{field:vod_hits} 次播放</p>
                    </div>
                </a>
            </div>
            {/vodlist:vod}
        </div>
    </div>
</div>
<include file="BlockTheme:footer" />