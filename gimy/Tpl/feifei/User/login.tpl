<include file="BlockTheme:header" />
<div class="container">
    <div class="login-page">
        <div class="auth-form">
            <h2>登录</h2>
            <form action="{:ff_url('user/loginpost')}" method="post">
                <div class="form-group">
                    <label for="user_name">用户名</label>
                    <input type="text" id="user_name" name="user_name" required>
                </div>
                <div class="form-group">
                    <label for="user_pwd">密码</label>
                    <input type="password" id="user_pwd" name="user_pwd" required>
                </div>
                <div class="form-group">
                    <label for="user_vcode">
                        <input type="text" id="user_vcode" name="user_vcode" placeholder="验证码" required>
                        <img src="{:ff_url('user/vcode')}" onclick="this.src='{:ff_url('user/vcode')}?'+Math.random()" alt="验证码">
                    </label>
                </div>
                <button type="submit" class="btn">登录</button>
            </form>
            <p><a href="{:ff_url('user/register')}">注册账号</a> | <a href="{:ff_url('user/forget')}">忘记密码</a></p>
        </div>
    </div>
</div>
<include file="BlockTheme:footer" />