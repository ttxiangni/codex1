<include file="BlockTheme:header" />
<div class="container">
    <div class="user-center">
        <include file="User:center_nav" />
        <div class="content">
            <h2>我的收藏</h2>
            <div class="grid">
                {record:vod type="2" uid="{$user_id}" num="24"}
                <include file="User:inc_item_record" />
                {/record:vod}
            </div>
        </div>
    </div>
</div>
<include file="User:footer" />