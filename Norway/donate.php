<?php
// ====================== donate.php ======================
// Støtt utvikleren side — Your Site PRO v1.0 (Norsk Bokmål)
// Author: Ruslan Bilohash | bilohash.com | 2026
$json = json_decode(file_get_contents('content.json'), true);
$d = $json['donate'] ?? [];
?>
<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Støtt utvikleren | <?= htmlspecialchars($json['general']['site_name'] ?? 'Ditt Nettsted') ?></title>
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
                <span class="text-3xl font-bold tracking-tight"><?= htmlspecialchars($json['header']['logo_text'] ?? 'Ditt Nettsted') ?></span>
            </div>
            <a href="index.php" class="text-emerald-600 hover:text-emerald-700 font-medium flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Tilbake til forsiden
            </a>
        </div>
    </header>

    <!-- HERO DONATE -->
    <section class="hero-donate h-screen flex items-center text-white">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-3 bg-white/20 backdrop-blur-md px-8 py-3 rounded-3xl mb-8">
                <i class="fa-solid fa-heart text-4xl"></i>
                <span class="text-2xl font-semibold tracking-widest">SPONSORSTØTTE</span>
            </div>
            <h1 class="text-6xl md:text-7xl font-bold leading-none tracking-tighter mb-6">
                <?= htmlspecialchars($d['title'] ?? 'Støtt utvikleren') ?>
            </h1>
            <p class="text-2xl md:text-3xl max-w-2xl mx-auto mb-12 opacity-95">
                <?= htmlspecialchars($d['subtitle'] ?? 'Hvis denne malen hjalp deg — støtt utvikleren med en kaffe ☕') ?>
            </p>
            <div class="max-w-md mx-auto">
                <div class="donate-card bg-white text-gray-900 rounded-3xl p-10 shadow-2xl">
                    <p class="text-lg mb-8 leading-relaxed">
                        <?= htmlspecialchars($d['text'] ?? 'Hver støtte motiverer meg til å lage enda bedre maler.') ?>
                    </p>
                    <div class="grid gap-4">
                        <a href="<?= htmlspecialchars($d['buymeacoffee'] ?? '#') ?>" target="_blank" class="btn-donate flex items-center justify-center gap-3 bg-[#FFDD00] hover:bg-[#FFDD00]/90 text-black font-bold py-5 rounded-3xl text-lg">
                            <i class="fa-solid fa-mug-hot"></i> Buy Me a Coffee
                        </a>
                        <a href="<?= htmlspecialchars($d['wise'] ?? '#') ?>" target="_blank" class="btn-donate flex items-center justify-center gap-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-5 rounded-3xl text-lg">
                            <i class="fa-solid fa-globe"></i> Wise
                        </a>
                        <a href="<?= htmlspecialchars($d['paypal'] ?? '#') ?>" target="_blank" class="btn-donate flex items-center justify-center gap-3 bg-[#00457C] hover:bg-[#003366] text-white font-bold py-5 rounded-3xl text-lg">
                            <i class="fa-brands fa-paypal"></i> PayPal
                        </a>
                        <button onclick="copyVipps()" class="btn-donate flex items-center justify-center gap-3 bg-amber-500 hover:bg-amber-600 text-white font-bold py-5 rounded-3xl text-lg">
                            <i class="fa-solid fa-mobile-screen-button"></i> Vipps <small class="text-xs opacity-90">+47 462 55 885</small>
                        </button>
                    </div>
                    <div class="mt-10 flex flex-col items-center">
                        <img src="QR-kode-paypal.png" alt="PayPal QR-kode" class="rounded-2xl shadow-lg w-48 border border-gray-200">
                        <p class="text-sm text-gray-500 mt-3">PayPal QR-kode</p>
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
            btn.innerHTML = `<i class="fa-solid fa-check"></i> Kopiert!`;
            setTimeout(() => { btn.innerHTML = original; }, 2500);
        }
    </script>
</body>
</html>
