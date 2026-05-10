<include file="BlockTheme:header" />
<div class="container">
    <div class="user-center">
        <include file="User:center_nav" />
        <div class="content">
            <h2>我的话题</h2>
            <div class="forum-list">
                {forum:vod uid="{$user_id}" num="20"}
                <div class="forum-item">
                    <h4><a href="{field:url}">{field:forum_content|str_cut=50}</a></h4>
                    <p>{field:forum_addtime|date='Y-m-d H:i',###}</p>
                </div>
                {/forum:vod}
            </div>
        </div>
    </div>
</div>
<include file="User:footer" />