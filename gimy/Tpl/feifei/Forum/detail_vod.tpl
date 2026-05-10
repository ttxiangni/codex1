<include file="BlockTheme:header" />
<div class="container">
    <div class="forum-detail">
        <h1>影片评论 - {vod:detail}{field:name}{/vod:detail}</h1>
        
        <div class="forum-form">
            {if condition="$user_id"}
            <form action="{:ff_url('forum/update')}" method="post">
                <input type="hidden" name="forum_cid" value="{vod:id}">
                <input type="hidden" name="forum_sid" value="1">
                <textarea name="forum_content" placeholder="写下你的评论..." required></textarea>
                <button type="submit" class="btn">发表评论</button>
            </form>
            {else}
            <p>请 <a href="{:ff_url('user/login')}">登录</a> 后发表评论</p>
            {/if}
        </div>

        <div class="forum-list">
            {forum:vod id="{vod:id}"}
            <include file="BlockTheme:forum_item" />
            {/forum:vod}
        </div>
    </div>
</div>
<include file="BlockTheme:footer" />