<include file="BlockTheme:header" />
<div class="container">
    <div class="play-page">
        <div class="player-section">
            <div class="player">
                <div id="player-container">
                    <!-- 播放器代码 -->
                    <iframe src="{vod:detail}{field:playurl}{/vod:detail}" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="episode-list">
                <h3>选集</h3>
                <ul>
                    {vod:detail}
                    {playurl:vod num="50"}
                    <li><a href="{field:url}" {if condition="$vod_id eq $play_id"}class="active"{/if}>{field:title}</a></li>
                    {/playurl:vod}
                    {/vod:detail}
                </ul>
            </div>
        </div>

        <div class="play-info">
            <h1>{vod:detail}{field:name}{/vod:detail}</h1>
            <p>更新至：{vod:detail}{field:state}{/vod:detail}</p>
        </div>

        <include file="BlockTheme:forum_inc_vod" />
    </div>
</div>
<include file="BlockTheme:footer" />