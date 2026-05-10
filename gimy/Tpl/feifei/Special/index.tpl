<include file="BlockTheme:header" />
<div class="container">
    <div class="special-page">
        <h1>专题列表</h1>
        <div class="special-grid">
            {topiclist:vod num="20"}
            <div class="special-item">
                <a href="{field:url}">
                    <img src="{field:pic}" alt="{field:name}">
                    <h3>{field:name}</h3>
                    <p>{field:content|str_cut=50}</p>
                </a>
            </div>
            {/topiclist:vod}
        </div>
    </div>
</div>
<include file="BlockTheme:footer" />