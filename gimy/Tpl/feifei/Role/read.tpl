<include file="BlockTheme:header" />
<div class="container">
    <div class="role-detail">
        <div class="role-header">
            <img src="{role:detail}{field:pic}{/role:detail}" alt="{role:detail}{field:name}{/role:detail}">
            <div class="role-info">
                <h1>{role:detail}{field:name}{/role:detail}</h1>
                <p>演员：{role:detail}{field:actor}{/role:detail}</p>
                <p>简介：{role:detail}{field:content}{/role:detail}</p>
            </div>
        </div>
        
        <div class="role-works">
            <h2>登场作品</h2>
            <div class="grid">
                {vodlist:vod role="{role:name}" num="24"}
                <include file="BlockTheme:item_img_vod" />
                {/vodlist:vod}
            </div>
        </div>
    </div>
</div>
<include file="BlockTheme:footer" />