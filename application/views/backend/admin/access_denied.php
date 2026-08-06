<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Access Denied</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f6f9; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .denied-box { text-align: center; background: #fff; padding: 45px 55px; border-radius: 8px; box-shadow: 0 3px 12px rgba(0,0,0,.12); max-width: 420px; }
        .denied-box .icon { font-size: 52px; color: #e74c3c; margin-bottom: 12px; }
        .denied-box h1 { font-size: 24px; color: #333; margin-bottom: 8px; }
        .denied-box p { font-size: 14px; color: #777; margin-bottom: 22px; line-height: 1.6; }
        .denied-box a { display: inline-block; padding: 9px 22px; background: #333; color: #fff; text-decoration: none; border-radius: 4px; font-size: 13px; }
        .denied-box a:hover { background: #555; }
    </style>
</head>
<body>
    <div class="denied-box">
        <div class="icon">&#128274;</div>
        <h1>Access Denied</h1>
        <p>You do not have permission to view this page. Please contact the administrator if you believe this is a mistake.</p>
        <a href="<?php echo base_url();?>admin/dashboard">Go to Dashboard</a>
    </div>
</body>
</html>
