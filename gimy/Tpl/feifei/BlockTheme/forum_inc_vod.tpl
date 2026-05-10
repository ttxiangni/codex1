<section class="forum-section">
    <h3>影片评论</h3>
    <div class="forum-form">
        {if condition="$user_id"}
        <form action="{:ff_url('forum/update')}" method="post" id="forum-form">
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
        {forum:vod id="{vod:id}" num="10"}
        <include file="BlockTheme:forum_item" />
        {/forum:vod}
    </div>

    <div class="forum-more">
        <a href="{:ff_url('vod/forum',array('id'=>$vod_id))}" class="btn">查看全部评论</a>
    </div>
</section>