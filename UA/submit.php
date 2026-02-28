<?php
// ====================== submit.php ======================
// Покращений обробник форми з ГАРНИМ УКРАЇНСЬКИМ HTML-EMAIL
// Автор: Ruslan Bilohash | bilohash.com | 2026

$json = json_decode(file_get_contents('content.json'), true);
$email = $json['email_settings'] ?? [];

$to           = $email['recipient'] ?? 'info@your-site.com';
$from_email   = $email['from_email'] ?? 'no-reply@your-site.com';
$from_name    = $email['from_name'] ?? 'Your site PRO';
$subject_pref = $email['subject_prefix'] ?? 'Нове замовлення — ';
$success_url  = $email['success_redirect'] ?? '?success=1';
$error_url    = $email['error_redirect'] ?? '?error=1';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = trim(strip_tags($_POST['name'] ?? ''));
    $phone   = trim(strip_tags($_POST['phone'] ?? ''));
    $message = trim(strip_tags($_POST['message'] ?? ''));

    if (empty($name) || empty($phone)) {
        header("Location: index.php" . $error_url);
        exit;
    }

    $subject = $subject_pref . $name . " — " . date('d.m.Y H:i');

    // === КРАСИВИЙ УКРАЇНСЬКИЙ HTML EMAIL ===
    $body = '
    <!DOCTYPE html>
    <html lang="uk">
    <head>
        <meta charset="UTF-8">
        <title>Нове замовлення</title>
        <style>
            body {font-family: Inter, system-ui, sans-serif; background:#f8fafc; margin:0; padding:40px 20px;}
            .container {max-width:640px; margin:0 auto; background:#ffffff; border-radius:24px; overflow:hidden; box-shadow:0 20px 60px rgba(16,185,129,0.15);}
            .header {background:linear-gradient(135deg, #10b981, #14b8a6); color:#fff; padding:50px 40px; text-align:center;}
            .header h1 {margin:0; font-size:32px; font-weight:700;}
            .content {padding:50px 45px; line-height:1.8; color:#1f2937;}
            .info {background:#f1f5f9; padding:30px; border-radius:20px; margin:30px 0;}
            .label {font-weight:700; color:#0f766e; display:inline-block; width:160px;}
            .footer {text-align:center; padding:40px; background:#f8fafc; color:#64748b; font-size:15px;}
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>🧼 Нове замовлення</h1>
                <p style="margin:12px 0 0 0; opacity:0.95;">' . htmlspecialchars($email['company_name']) . ' • ' . htmlspecialchars($email['city']) . '</p>
            </div>
            <div class="content">
                <p><strong>Добрий день!</strong></p>
                <p>Ви отримали нову заявку на .</p>
                
                <div class="info">
                    <strong>👤 Дані клієнта</strong><br><br>
                    <span class="label">Ім’я:</span> ' . htmlspecialchars($name) . '<br>
                    <span class="label">Телефон:</span> <a href="tel:' . htmlspecialchars($phone) . '">' . htmlspecialchars($phone) . '</a><br><br>
                    <span class="label">Адреса та побажання:</span><br>
                    ' . nl2br(htmlspecialchars($message)) . '
                </div>
                
                <p><strong>Дата заявки:</strong> ' . date('d.m.Y о H:i') . '</p>
                <p><strong>Сайт:</strong> <a href="' . htmlspecialchars($_SERVER['HTTP_REFERER'] ?? 'https://yourdomain.com') . '" style="color:#10b981;">yourdomain.com</a></p>
                
                <p style="margin-top:35px; font-weight:600; color:#10b981;">Будь ласка, зв’яжіться з клієнтом якнайшвидше для підтвердження часу.</p>
            </div>
            <div class="footer">
                ' . htmlspecialchars($email['company_name']) . ' — Ваш сайт ' . htmlspecialchars($email['city']) . '<br>
                Дякуємо за швидку реакцію! ❤️
            </div>
        </div>
    </body>
    </html>';

    $headers = "From: {$from_name} <{$from_email}>\r\n";
    $headers .= "Reply-To: {$phone}\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";
    $headers .= "MIME-Version: 1.0\r\n";

    if (mail($to, $subject, $body, $headers)) {
        // Універсальний редирект для всіх мов
        $referer = $_SERVER['HTTP_REFERER'] ?? '';
        $base = 'index.php';
        if (strpos($referer, 'en.php') !== false) $base = 'en.php';
        elseif (strpos($referer, 'ru.php') !== false) $base = 'ru.php';
        elseif (strpos($referer, 'no.php') !== false) $base = 'no.php';
        elseif (strpos($referer, 'ua.php') !== false) $base = 'ua.php';

        header("Location: " . $base . $success_url);
        exit;
    } else {
        header("Location: index.php" . $error_url);
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>