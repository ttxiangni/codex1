<include file="BlockTheme:header" />
<div class="container">
    <div class="user-center">
        <include file="User:center_nav" />
        <div class="content">
            <h2>账号管理</h2>
            <form action="{:ff_url('user/update')}" method="post">
                <div class="form-group">
                    <label>用户名</label>
                    <input type="text" name="user_name" value="{$user_name}" readonly>
                </div>
                <div class="form-group">
                    <label>邮箱</label>
                    <input type="email" name="user_email" value="{$user_email}">
                </div>
                <div class="form-group">
                    <label>昵称</label>
                    <input type="text" name="user_nick" value="{$user_nick}">
                </div>
                <button type="submit" class="btn">保存修改</button>
            </form>
        </div>
    </div>
</div>
<include file="User:footer" />