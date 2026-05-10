<div class="forum-item">
    <div class="forum-header">
        <div class="forum-user">
            <img src="{field:user_pic|default='{$public_path}static/images/avatar.svg'}" alt="{field:user_name}">
            <span class="user-name">{field:user_name}</span>
        </div>
        <div class="forum-meta">
            <span class="forum-time">{field:forum_addtime|date='Y-m-d H:i',###}</span>
            <div class="forum-actions">
                <button onclick="forumUp({field:id})">👍 {field:forum_up}</button>
                <button onclick="forumDown({field:id})">👎 {field:forum_down}</button>
                <button onclick="showReplyForm({field:id})">回复</button>
            </div>
        </div>
    </div>
    <div class="forum-content">
        {field:forum_content}
    </div>
    <div class="forum-replies" id="replies-{field:id}">
        {forum:reply pid="{field:id}" num="3"}
        <div class="forum-reply">
            <div class="reply-user">
                <img src="{field:user_pic|default='{$public_path}static/images/avatar.svg'}" alt="{field:user_name}">
                <span class="user-name">{field:user_name}</span>
            </div>
            <div class="reply-content">
                {field:forum_content}
            </div>
            <div class="reply-meta">
                <span class="reply-time">{field:forum_addtime|date='Y-m-d H:i',###}</span>
                <button onclick="forumUp({field:id})">👍 {field:forum_up}</button>
            </div>
        </div>
        {/forum:reply}
    </div>
    <div class="reply-form" id="reply-form-{field:id}" style="display:none;">
        {if condition="$user_id"}
        <form action="{:ff_url('forum/update')}" method="post">
            <input type="hidden" name="forum_pid" value="{field:id}">
            <input type="hidden" name="forum_cid" value="{vod:id}">
            <input type="hidden" name="forum_sid" value="1">
            <textarea name="forum_content" placeholder="回复 {field:user_name}..." required></textarea>
            <button type="submit" class="btn">回复</button>
            <button type="button" onclick="hideReplyForm({field:id})">取消</button>
        </form>
        {/if}
    </div>
</div>