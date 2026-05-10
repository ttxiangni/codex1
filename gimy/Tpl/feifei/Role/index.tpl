<include file="BlockTheme:header" />
<div class="container">
    <div class="role-page">
        <h1>角色索引</h1>
        <div class="role-index">
            {rolelist:vod num="100" order="role_hits desc"}
            <div class="role-item">
                <a href="{field:url}">
                    <img src="{field:pic}" alt="{field:name}">
                    <h3>{field:name}</h3>
                </a>
            </div>
            {/rolelist:vod}
        </div>
    </div>
</div>
<include file="BlockTheme:footer" />