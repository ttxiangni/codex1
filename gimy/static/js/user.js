// 用户相关功能
function login(formData) {
    fetch('/index.php?s=user-loginpost', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 1) {
            window.location.reload();
        } else {
            alert(data.info);
        }
    })
    .catch(error => {
        console.error('Login error:', error);
        alert('登录失败，请重试');
    });
}

function register(formData) {
    fetch('/index.php?s=user-post', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 1) {
            alert('注册成功，请登录');
            window.location.href = '/index.php?s=user-login';
        } else {
            alert(data.info);
        }
    })
    .catch(error => {
        console.error('Register error:', error);
        alert('注册失败，请重试');
    });
}

function forgetPassword(formData) {
    fetch('/index.php?s=user-forgetpost', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 1) {
            alert('重置邮件已发送，请检查邮箱');
        } else {
            alert(data.info);
        }
    })
    .catch(error => {
        console.error('Forget password error:', error);
        alert('发送失败，请重试');
    });
}

// 评论功能
function submitComment(formData) {
    fetch('/index.php?s=forum-update', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 1) {
            window.location.reload();
        } else {
            alert(data.info);
        }
    })
    .catch(error => {
        console.error('Comment submit error:', error);
        alert('评论提交失败，请重试');
    });
}

function forumUp(id) {
    fetch(`/index.php?s=ajax-forum-up&id=${id}`)
    .then(response => response.json())
    .then(data => {
        if (data.status === 1) {
            const btn = document.querySelector(`[onclick="forumUp(${id})"]`);
            btn.textContent = `👍 ${data.up}`;
        }
    })
    .catch(error => console.error('Forum up error:', error));
}

function forumDown(id) {
    fetch(`/index.php?s=ajax-forum-down&id=${id}`)
    .then(response => response.json())
    .then(data => {
        if (data.status === 1) {
            const btn = document.querySelector(`[onclick="forumDown(${id})"]`);
            btn.textContent = `👎 ${data.down}`;
        }
    })
    .catch(error => console.error('Forum down error:', error));
}

function showReplyForm(id) {
    const form = document.getElementById(`reply-form-${id}`);
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

function hideReplyForm(id) {
    document.getElementById(`reply-form-${id}`).style.display = 'none';
}

// 收藏功能
function addToFavorites(vodId) {
    fetch(`/index.php?s=user-favorites&id=${vodId}`)
    .then(response => response.json())
    .then(data => {
        if (data.status === 1) {
            alert('已添加到收藏');
        } else {
            alert(data.info || '操作失败');
        }
    })
    .catch(error => {
        console.error('Add to favorites error:', error);
        alert('操作失败，请重试');
    });
}

// 表单提交处理
document.addEventListener('DOMContentLoaded', function() {
    // 登录表单
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            login(formData);
        });
    }
    
    // 注册表单
    const registerForm = document.getElementById('register-form');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            register(formData);
        });
    }
    
    // 忘记密码表单
    const forgetForm = document.getElementById('forget-form');
    if (forgetForm) {
        forgetForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            forgetPassword(formData);
        });
    }
    
    // 评论表单
    const commentForms = document.querySelectorAll('#forum-form, [id^="reply-form-"] form');
    commentForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            submitComment(formData);
        });
    });
});