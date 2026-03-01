<?php
// ====================== submit.php ======================
// Forbedret skjemahåndterer med VAKKER NORSK HTML-EPOST
// Author: Ruslan Bilohash | bilohash.com | 2026

$json = json_decode(file_get_contents('content.json'), true);
$email = $json['email_settings'] ?? [];

$to = $email['recipient'] ?? 'info@your-site.com';
$from_email = $email['from_email'] ?? 'no-reply@your-site.com';
$from_name = $email['from_name'] ?? 'Ditt Nettsted PRO';
$subject_pref = $email['subject_prefix'] ?? 'Ny bestilling — ';
$success_url = $email['success_redirect'] ?? '?success=1';
$error_url = $email['error_redirect'] ?? '?error=1';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim(strip_tags($_POST['name'] ?? ''));
    $phone = trim(strip_tags($_POST['phone'] ?? ''));
    $message = trim(strip_tags($_POST['message'] ?? ''));

    if (empty($name) || empty($phone)) {
        header("Location: index.php" . $error_url);
        exit;
    }

    $subject = $subject_pref . $name . " — " . date('d.m.Y H:i');

    // === VAKKER NORSK HTML-EPOST ===
    $body = '
    <!DOCTYPE html>
    <html lang="no">
    <head>
        <meta charset="UTF-8">
        <title>Ny bestilling</title>
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
                <h1>🧼 Ny bestilling</h1>
                <p style="margin:12px 0 0 0; opacity:0.95;">' . htmlspecialchars($email['company_name'] ?? '') . ' • ' . htmlspecialchars($email['city'] ?? '') . '</p>
            </div>
            <div class="content">
                <p><strong>Hei!</strong></p>
                <p>Du har mottatt en ny forespørsel fra nettsiden.</p>
                <div class="info">
                    <strong>👤 Kundeinformasjon</strong><br><br>
                    <span class="label">Navn:</span> ' . htmlspecialchars($name) . '<br>
                    <span class="label">Telefon:</span> <a href="tel:' . htmlspecialchars($phone) . '">' . htmlspecialchars($phone) . '</a><br><br>
                    <span class="label">Adresse og ønsker:</span><br>
                    ' . nl2br(htmlspecialchars($message)) . '
                </div>
                <p><strong>Bestillingsdato:</strong> ' . date('d.m.Y kl. H:i') . '</p>
                <p><strong>Nettsted:</strong> <a href="' . htmlspecialchars($_SERVER['HTTP_REFERER'] ?? 'https://yourdomain.com') . '" style="color:#10b981;">yourdomain.com</a></p>
                <p style="margin-top:35px; font-weight:600; color:#10b981;">Vennligst kontakt kunden så snart som mulig for å bekrefte tidspunkt.</p>
            </div>
            <div class="footer">
                ' . htmlspecialchars($email['company_name'] ?? '') . ' — Ditt nettsted ' . htmlspecialchars($email['city'] ?? '') . '<br>
                Takk for rask respons! ❤️
            </div>
        </div>
    </body>
    </html>';

    $headers = "From: {$from_name} <{$from_email}>\r\n";
    $headers .= "Reply-To: {$from_email}\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";
    $headers .= "MIME-Version: 1.0\r\n";

    if (mail($to, $subject, $body, $headers)) {
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
