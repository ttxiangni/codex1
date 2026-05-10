<include file="BlockTheme:header" />
<div class="container">
    <div class="actor-page">
        <h1>演员索引</h1>
        <div class="actor-index">
            {actorlist:vod num="100" order="actor_hits desc"}
            <div class="actor-item">
                <a href="{field:url}">
                    <img src="{field:pic}" alt="{field:name}">
                    <h3>{field:name}</h3>
                </a>
            </div>
            {/actorlist:vod}
        </div>
    </div>
</div>
<include file="BlockTheme:footer" />