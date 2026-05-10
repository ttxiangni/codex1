<section class="hot-vod">
    <h3>本类热播</h3>
    <div class="hot-list">
        {vodlist:vod type="{vod:type_id}" order="vod_hits desc" num="10"}
        <div class="hot-item">
            <a href="{field:url}">
                <img src="{field:pic}" alt="{field:name}">
                <div class="hot-info">
                    <h5>{field:name}</h5>
                    <p>{field:vod_hits} 次播放</p>
                </div>
            </a>
        </div>
        {/vodlist:vod}
    </div>
</section>