<include file="BlockTheme:header" />
<div class="container">
    <div class="hero-section">
        <div class="hero-main">
            <h1>热门推荐</h1>
            <div class="hero-grid">
                {vodlist:vod num="6" order="vod_hits desc"}
                <div class="hero-item">
                    <a href="{field:url}">
                        <img src="{field:pic}" alt="{field:name}">
                        <h3>{field:name}</h3>
                    </a>
                </div>
                {/vodlist:vod}
            </div>
        </div>
        <div class="hero-sidebar">
            {vodlist:vod num="10" order="vod_addtime desc"}
            <include file="BlockTheme:item_side_vod" />
            {/vodlist:vod}
        </div>
    </div>

    <section class="hot-section">
        <h2>热播推荐</h2>
        <div class="grid">
            {vodlist:vod num="12" order="vod_stars desc"}
            <include file="BlockTheme:item_img_vod" />
            {/vodlist:vod}
        </div>
    </section>

    <section class="recent-section">
        <h2>最近更新</h2>
        <div class="recent-list">
            {vodlist:vod num="20" order="vod_addtime desc"}
            <include file="BlockTheme:item_txt_vod" />
            {/vodlist:vod}
        </div>
    </section>

    {typelist:vodtype num="8" order="type_sort desc"}
    <section class="category-section">
        <h2>{field:name}</h2>
        <div class="grid">
            {vodlist:vod num="6" type="{field:id}" order="vod_hits desc"}
            <include file="BlockTheme:item_img_vod" />
            {/vodlist:vod}
        </div>
    </section>
    {/typelist:vodtype}
</div>
<include file="BlockTheme:footer" />