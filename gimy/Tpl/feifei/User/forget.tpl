<include file="BlockTheme:header" />
<div class="container">
    <div class="forget-page">
        <div class="auth-form">
            <h2>找回密码</h2>
            <form action="{:ff_url('user/forgetpost')}" method="post">
                <div class="form-group">
                    <label for="user_email">邮箱</label>
                    <input type="email" id="user_email" name="user_email" required>
                </div>
                <div class="form-group">
                    <label for="user_vcode">
                        <input type="text" id="user_vcode" name="user_vcode" placeholder="验证码" required>
                        <img src="{:ff_url('user/vcode')}" onclick="this.src='{:ff_url('user/vcode')}?'+Math.random()" alt="验证码">
                    </label>
                </div>
                <button type="submit" class="btn">发送重置邮件</button>
            </form>
            <p><a href="{:ff_url('user/login')}">返回登录</a></p>
        </div>
    </div>
</div>
<include file="BlockTheme:footer" />