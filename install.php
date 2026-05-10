<?php
/**
 * FeiFei CMS - 影视内容管理系统
 * 安装程序
 */

// 设置时区
date_default_timezone_set('Asia/Shanghai');

// 检查PHP版本
if (version_compare(PHP_VERSION, '7.4', '<')) {
    die('PHP版本过低，需要7.4或更高版本');
}

// 定义项目路径
define('BASE_PATH', __DIR__ . '/');
define('CONFIG_PATH', BASE_PATH . 'config/');

class Installer
{
    private $step = 1;
    private $config = [];
    private $errors = [];

    public function run()
    {
        $action = $_GET['action'] ?? 'index';

        switch ($action) {
            case 'check':
                $this->step = 2;
                $this->checkEnvironment();
                break;
            case 'database':
                $this->step = 3;
                $this->renderDatabaseForm();
                break;
            case 'install':
                $this->step = 4;
                $this->installDatabase();
                break;
            case 'finish':
                $this->step = 5;
                $this->finish();
                break;
            default:
                $this->renderIndex();
        }
    }

    /**
     * 渲染首页
     */
    private function renderIndex()
    {
        ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FeiFei CMS - 安装好的系统</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .install-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 600px;
            margin: 0 auto;
            overflow: hidden;
        }
        .install-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .install-body {
            padding: 40px;
        }
        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .step {
            flex: 1;
            text-align: center;
            position: relative;
        }
        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-weight: bold;
        }
        .step.active .step-number {
            background: #667eea;
            color: white;
        }
        .step.completed .step-number {
            background: #28a745;
            color: white;
        }
    </style>
</head>
<body>
    <div class="install-container">
        <div class="install-header">
            <h1>FeiFei CMS</h1>
            <p class="mb-0">影视内容管理系统 - 安装向导</p>
        </div>

        <div class="install-body">
            <div class="step-indicator">
                <div class="step <?php echo $this->step >= 1 ? ($this->step > 1 ? 'completed' : 'active') : ''; ?>">
                    <div class="step-number">1</div>
                    <small>欢迎</small>
                </div>
                <div class="step <?php echo $this->step >= 2 ? ($this->step > 2 ? 'completed' : 'active') : ''; ?>">
                    <div class="step-number">2</div>
                    <small>环境检测</small>
                </div>
                <div class="step <?php echo $this->step >= 3 ? ($this->step > 3 ? 'completed' : 'active') : ''; ?>">
                    <div class="step-number">3</div>
                    <small>数据库配置</small>
                </div>
                <div class="step <?php echo $this->step >= 4 ? ($this->step > 4 ? 'completed' : 'active') : ''; ?>">
                    <div class="step-number">4</div>
                    <small>完成安装</small>
                </div>
            </div>

            <h3 class="mb-4">欢迎使用 FeiFei CMS</h3>
            <p>FeiFei CMS 是一个强大的影视内容管理系统，具有以下特点：</p>
            <ul>
                <li>✓ 完整的视频管理功能</li>
                <li>✓ 支持评论、收藏、历史记录</li>
                <li>✓ 文章资讯模块</li>
                <li>✓ 演员和角色管理</li>
                <li>✓ 采集系统（支持MacCMS格式）</li>
                <li>✓ SEO优化</li>
                <li>✓ 黑夜模式</li>
                <li>✓ 高效缓存系统</li>
            </ul>

            <div class="alert alert-info">
                <strong>注意：</strong> 请确保您已经准备好MySQL数据库连接信息。
            </div>

            <div class="d-grid gap-2">
                <a href="?action=check" class="btn btn-primary btn-lg">
                    开始安装 <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
        <?php
    }

    /**
     * 环境检测
     */
    private function checkEnvironment()
    {
        $checks = [
            'PHP版本' => version_compare(PHP_VERSION, '7.4') >= 0,
            'PDO扩展' => extension_loaded('pdo'),
            'MySQL驱动' => extension_loaded('pdo_mysql'),
            'cURL扩展' => extension_loaded('curl'),
            'JSON扩展' => extension_loaded('json'),
            'Redis扩展' => extension_loaded('redis'),
            'config目录可写' => is_writable(CONFIG_PATH),
            'public/uploads目录可写' => is_writable(BASE_PATH . 'public/uploads'),
        ];

        $allPassed = true;
        foreach ($checks as $check => $result) {
            if (!$result) {
                $allPassed = false;
            }
        }

        ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>环境检测 - FeiFei CMS安装</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center;">
    <div class="container">
        <div style="background: white; border-radius: 10px; padding: 40px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); max-width: 600px; margin: 0 auto;">
            <h2 class="mb-4">系统环境检测</h2>

            <div class="list-group">
                <?php foreach ($checks as $name => $result): ?>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <strong><?php echo $name; ?></strong>
                    <?php if ($result): ?>
                        <span class="badge bg-success">✓ 正常</span>
                    <?php else: ?>
                        <span class="badge bg-danger">✗ 不满足</span>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-4">
                <?php if ($allPassed): ?>
                    <div class="alert alert-success">所有检测项目都已通过！</div>
                    <div class="d-grid gap-2">
                        <a href="?action=database" class="btn btn-primary btn-lg">下一步 → 数据库配置</a>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger">有些环境不满足要求，请检查后重试。</div>
                    <div class="d-grid gap-2">
                        <a href="?action=check" class="btn btn-warning btn-lg">重新检测</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
        <?php
    }

    /**
     * 数据库配置表单
     */
    private function renderDatabaseForm()
    {
        // 加载现有配置（如果存在）
        $dbConfig = [
            'hostname' => 'localhost',
            'database' => 'feifei_cms',
            'username' => 'root',
            'password' => '',
            'port' => 3306,
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dbConfig = [
                'hostname' => $_POST['hostname'] ?? 'localhost',
                'database' => $_POST['database'] ?? '',
                'username' => $_POST['username'] ?? '',
                'password' => $_POST['password'] ?? '',
                'port' => $_POST['port'] ?? 3306,
            ];

            // 测试数据库连接
            try {
                $dsn = "mysql:host={$dbConfig['hostname']};port={$dbConfig['port']}";
                $pdo = new \PDO($dsn, $dbConfig['username'], $dbConfig['password']);
                
                // 创建数据库
                $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbConfig['database']}`");
                $pdo->exec("USE `{$dbConfig['database']}`");

                // 保存配置
                $_SESSION['db_config'] = $dbConfig;

                header('Location: ?action=install');
                exit;
            } catch (\Exception $e) {
                $error = '数据库连接失败：' . $e->getMessage();
            }
        }

        ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>数据库配置 - FeiFei CMS安装</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center;">
    <div class="container">
        <div style="background: white; border-radius: 10px; padding: 40px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); max-width: 600px; margin: 0 auto;">
            <h2 class="mb-4">数据库配置</h2>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label for="hostname" class="form-label">数据库主机</label>
                    <input type="text" class="form-control" id="hostname" name="hostname" value="<?php echo htmlspecialchars($dbConfig['hostname']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="port" class="form-label">数据库端口</label>
                    <input type="number" class="form-control" id="port" name="port" value="<?php echo $dbConfig['port']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="database" class="form-label">数据库名称</label>
                    <input type="text" class="form-control" id="database" name="database" value="<?php echo htmlspecialchars($dbConfig['database']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">数据库用户名</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($dbConfig['username']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">数据库密码</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($dbConfig['password']); ?>">
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">测试连接并创建数据库</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
        <?php
    }

    /**
     * 安装数据库
     */
    private function installDatabase()
    {
        session_start();
        $dbConfig = $_SESSION['db_config'] ?? null;

        if (!$dbConfig) {
            header('Location: ?action=database');
            exit;
        }

        try {
            $dsn = "mysql:host={$dbConfig['hostname']};port={$dbConfig['port']};dbname={$dbConfig['database']};charset=utf8mb4";
            $pdo = new \PDO($dsn, $dbConfig['username'], $dbConfig['password']);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // 执行SQL文件
            $sqlFile = BASE_PATH . 'install/database.sql';
            if (file_exists($sqlFile)) {
                $sql = file_get_contents($sqlFile);
                $statements = explode(';', $sql);
                
                foreach ($statements as $statement) {
                    $statement = trim($statement);
                    if (!empty($statement)) {
                        $pdo->exec($statement);
                    }
                }
            }

            // 保存数据库配置
            $this->saveDbConfig($dbConfig);

            $_SESSION['install_success'] = true;
            header('Location: ?action=finish');
            exit;
        } catch (\Exception $e) {
            $error = '安装失败：' . $e->getMessage();
        }

        ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>安装进行中 - FeiFei CMS安装</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center;">
    <div class="container">
        <div style="background: white; border-radius: 10px; padding: 40px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); max-width: 600px; margin: 0 auto;">
            <h2 class="mb-4">正在安装...</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php else: ?>
                <div class="alert alert-info">正在创建数据库表...</div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
        <?php
    }

    /**
     * 完成安装
     */
    private function finish()
    {
        session_start();
        $success = $_SESSION['install_success'] ?? false;

        ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>安装完成 - FeiFei CMS安装</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center;">
    <div class="container">
        <div style="background: white; border-radius: 10px; padding: 40px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); max-width: 600px; margin: 0 auto; text-align: center;">
            <h1 style="font-size: 48px; color: #28a745; margin-bottom: 20px;">✓</h1>
            <h2 class="mb-3">安装成功！</h2>
            <p class="text-muted">FeiFei CMS 已成功安装，您可以开始使用了。</p>

            <div class="alert alert-warning">
                <strong>重要提醒：</strong><br>
                请立即删除 install.php 文件，以保护您的系统安全。
            </div>

            <div class="mb-4">
                <h5>默认登录信息：</h5>
                <p>用户名: <code>admin</code></p>
                <p>密码: <code>admin123</code></p>
                <small class="text-muted">（请在登录后立即修改密码）</small>
            </div>

            <div class="d-grid gap-2">
                <a href="/" class="btn btn-primary btn-lg">进入首页</a>
                <a href="/admin" class="btn btn-secondary btn-lg">进入管理后台</a>
            </div>
        </div>
    </div>
</body>
</html>
        <?php
    }

    /**
     * 保存数据库配置
     */
    private function saveDbConfig($dbConfig)
    {
        $config = "<?php\n\nreturn [\n";
        $config .= "    'default' => env('db.driver', 'mysql'),\n\n";
        $config .= "    'mysql' => [\n";
        $config .= "        'type' => 'mysql',\n";
        $config .= "        'hostname' => '{$dbConfig['hostname']}',\n";
        $config .= "        'database' => '{$dbConfig['database']}',\n";
        $config .= "        'username' => '{$dbConfig['username']}',\n";
        $config .= "        'password' => '{$dbConfig['password']}',\n";
        $config .= "        'hostport' => {$dbConfig['port']},\n";
        $config .= "        'charset' => 'utf8mb4',\n";
        $config .= "    ],\n";
        $config .= "];\n";

        file_put_contents(CONFIG_PATH . 'database.php', $config);
    }
}

// 启动会话
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$installer = new Installer();
$installer->run();
