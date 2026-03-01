<?php
// ====================== donate.php ======================
// Donation / Support the Author Page — Your Site PRO v1.0
// Author: Ruslan Bilohash | bilohash.com | 2026
// Повністю цілий файл — без жодного скорочення

$json = json_decode(file_get_contents('content.json'), true);
$d = $json['donate'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support the Author | <?= htmlspecialchars($json['general']['site_name'] ?? 'Your Site') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap');
        .hero-donate {
            background: linear-gradient(rgba(16,185,129,0.92), rgba(16,185,129,0.92)),
                        url('https://picsum.photos/seed/coffee-donate/2000/1200') center/cover no-repeat;
        }
        .donate-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .donate-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 30px 60px -15px rgb(16 185 129 / 0.5);
        }
        .btn-donate {
            transition: all 0.3s ease;
        }
        .btn-donate:hover {
            transform: translateY(-3px);
        }
    </style>
</head>
<body class="font-sans bg-gray-50 text-gray-900">
    <!-- HEADER -->
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-broom text-4xl text-emerald-600"></i>
                <span class="text-3xl font-bold tracking-tight"><?= htmlspecialchars($json['header']['logo_text'] ?? 'Your Site') ?></span>
            </div>
            <a href="index.php" class="text-emerald-600 hover:text-emerald-700 font-medium flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Back to Home
            </a>
        </div>
    </header>

    <!-- HERO DONATE -->
    <section class="hero-donate h-screen flex items-center text-white">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-3 bg-white/20 backdrop-blur-md px-8 py-3 rounded-3xl mb-8">
                <i class="fa-solid fa-heart text-4xl"></i>
                <span class="text-2xl font-semibold tracking-widest">SPONSORSHIP</span>
            </div>
           
            <h1 class="text-6xl md:text-7xl font-bold leading-none tracking-tighter mb-6">
                <?= htmlspecialchars($d['title'] ?? 'Support the Author') ?>
            </h1>
           
            <p class="text-2xl md:text-3xl max-w-2xl mx-auto mb-12 opacity-95">
                <?= htmlspecialchars($d['subtitle'] ?? 'If this template helped you — support the developer with a coffee ☕') ?>
            </p>
           
            <div class="max-w-md mx-auto">
                <div class="donate-card bg-white text-gray-900 rounded-3xl p-10 shadow-2xl">
                    <p class="text-lg mb-8 leading-relaxed">
                        <?= htmlspecialchars($d['text'] ?? 'Every donation motivates me to create even better templates.') ?>
                    </p>
                   
                    <div class="grid gap-4">

                       
                        <!-- Wise -->
                        <a href="<?= htmlspecialchars($d['wise'] ?? '#') ?>" target="_blank"
                           class="btn-donate flex items-center justify-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-5 rounded-3xl text-lg">
                            <i class="fa-solid fa-globe"></i> Wise
                        </a>
                       
                        <!-- PayPal -->
                        <a href="<?= htmlspecialchars($d['paypal'] ?? '#') ?>" target="_blank"
                           class="btn-donate flex items-center justify-center gap-3 bg-[#00457C] hover:bg-[#003366] text-white font-bold py-5 rounded-3xl text-lg">
                            <i class="fa-brands fa-paypal"></i> PayPal
                        </a>
                       
                        <!-- Vipps -->
                        <button onclick="copyVipps()"
                                class="btn-donate flex items-center justify-center gap-3 bg-amber-500 hover:bg-amber-600 text-white font-bold py-5 rounded-3xl text-lg">
                            <i class="fa-solid fa-mobile-screen-button"></i>
                            Vipps <small class="text-xs opacity-90">+47 462 55 885</small>
                        </button>
                    </div>

                    <!-- QR PayPal -->
                    <div class="mt-10 flex flex-col items-center">
                        <img src="QR-kode-paypal.png"
                             alt="PayPal QR Code"
                             class="rounded-2xl shadow-lg w-48 border border-gray-200">
                        <p class="text-sm text-gray-500 mt-3">PayPal QR Code</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function copyVipps() {
            navigator.clipboard.writeText('<?= htmlspecialchars($d['vipps'] ?? '+4746255885') ?>');
            const btn = document.querySelector('button[onclick="copyVipps()"]');
            const original = btn.innerHTML;
            btn.innerHTML = `<i class="fa-solid fa-check"></i> Copied!`;
            setTimeout(() => { btn.innerHTML = original; }, 2500);
        }
    </script>
</body>
</html>
