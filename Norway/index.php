<?php
// ====================== index.php (no.php) ======================
// Hoved landingsside — Your Site PRO v1.0 (Norsk Bokmål)
// Author: Ruslan Bilohash | bilohash.com | 2026
$json = json_decode(file_get_contents('content.json'), true);
$success = isset($_GET['success']) && $_GET['success'] == 1;
$error = isset($_GET['error']) && $_GET['error'] == 1 ? ($json['order_form']['error_text'] ?? 'Noe gikk galt. Prøv igjen senere.') : '';
?>
<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $json['custom_code']['head'] ?? '' ?>
    <title><?= htmlspecialchars($json['meta']['title'] ?? '') ?></title>
    <meta name="description" content="<?= htmlspecialchars($json['meta']['description'] ?? '') ?>">
    <meta name="keywords" content="<?= htmlspecialchars($json['meta']['keywords'] ?? '') ?>">
    <meta name="robots" content="<?= htmlspecialchars($json['meta']['robots'] ?? '') ?>">
    <meta name="author" content="<?= htmlspecialchars($json['meta']['author'] ?? '') ?>">
    <meta name="theme-color" content="<?= htmlspecialchars($json['meta']['theme_color'] ?? '') ?>">
    <link rel="canonical" href="<?= htmlspecialchars($json['meta']['canonical'] ?? '') ?>">
    <meta property="og:title" content="<?= htmlspecialchars($json['og']['title'] ?? '') ?>">
    <meta property="og:description" content="<?= htmlspecialchars($json['og']['description'] ?? '') ?>">
    <meta property="og:image" content="<?= htmlspecialchars($json['og']['image'] ?? '') ?>">
    <meta property="og:image:width" content="<?= htmlspecialchars($json['og']['image_width'] ?? '') ?>">
    <meta property="og:image:height" content="<?= htmlspecialchars($json['og']['image_height'] ?? '') ?>">
    <meta property="og:url" content="<?= htmlspecialchars($json['og']['url'] ?? '') ?>">
    <meta property="og:type" content="<?= htmlspecialchars($json['og']['type'] ?? '') ?>">
    <meta property="og:locale" content="<?= htmlspecialchars($json['og']['locale'] ?? '') ?>">
    <meta property="og:site_name" content="<?= htmlspecialchars($json['og']['site_name'] ?? '') ?>">
    <meta name="twitter:card" content="<?= htmlspecialchars($json['twitter']['card'] ?? '') ?>">
    <meta name="twitter:title" content="<?= htmlspecialchars($json['twitter']['title'] ?? '') ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($json['twitter']['description'] ?? '') ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($json['twitter']['image'] ?? '') ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap');
        .hero-bg { background: linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)), url('https://picsum.photos/seed/professional-cleaning-hero/2000/1200') center/cover no-repeat; }
        .card-hover { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .card-hover:hover { transform: translateY(-15px) scale(1.03); box-shadow: 0 25px 50px -12px rgb(16 185 129 / 0.4); }
        .gallery-img { transition: transform 0.4s; }
        .gallery-img:hover { transform: scale(1.08); }
        .service-img { transition: all 0.4s ease; }
        .service-img:hover { filter: brightness(1.1); }
        <?= $json['custom_code']['style'] ?? '' ?>
    </style>
</head>
<body class="font-sans bg-gray-50 text-gray-900">
    <!-- HEADER -->
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-broom text-4xl text-emerald-600"></i>
                <div><span class="text-3xl font-bold tracking-tight"><?= htmlspecialchars($json['header']['logo_text'] ?? '') ?></span></div>
            </div>
            <nav class="hidden md:flex items-center gap-8 text-lg font-medium">
                <?php foreach($json['header']['nav_items'] as $nav): ?>
                    <a href="<?= htmlspecialchars($nav['anchor'] ?? '#') ?>" class="hover:text-emerald-600 transition"><?= htmlspecialchars($nav['text'] ?? '') ?></a>
                <?php endforeach; ?>
            </nav>
            <div class="relative group">
                <button onclick="toggleLang()" class="flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-2xl transition">
                    <span class="flag">🇳🇴</span>
                    <span class="font-semibold">NO</span>
                    <i class="fa-solid fa-chevron-down text-xs"></i>
                </button>
                <div id="langDropdown" class="hidden group-hover:block absolute right-0 mt-3 bg-white shadow-2xl rounded-3xl py-4 w-52 z-50 border border-gray-100">
                    <a href="index.php" class="flex items-center gap-4 px-6 py-3 hover:bg-emerald-50 transition"><span class="flag">🇬🇧</span><span>English</span></a>
                    <a href="no.php" class="flex items-center gap-4 px-6 py-3 bg-emerald-50 text-emerald-700"><span class="flag">🇳🇴</span><span>Norsk</span></a>
                    <a href="ru.php" class="flex items-center gap-4 px-6 py-3 hover:bg-emerald-50 transition"><span class="flag">🇷🇺</span><span>Русский</span></a>
                    <a href="ua.php" class="flex items-center gap-4 px-6 py-3 hover:bg-emerald-50 transition"><span class="flag">🇺🇦</span><span>Українська</span></a>
                </div>
            </div>
            <button onclick="toggleMobileMenu()" class="md:hidden text-3xl"><i class="fa-solid fa-bars"></i></button>
        </div>
    </header>

    <!-- MOBILE MENU -->
    <div id="mobileMenu" class="hidden md:hidden fixed inset-0 bg-white z-50 pt-20 px-6">
        <div class="flex flex-col gap-6 text-2xl font-medium">
            <?php foreach($json['header']['nav_items'] as $nav): ?>
                <a href="<?= htmlspecialchars($nav['anchor'] ?? '#') ?>" onclick="toggleMobileMenu()" class="py-3 border-b"><?= htmlspecialchars($nav['text'] ?? '') ?></a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- HERO -->
    <section class="hero-bg h-screen flex items-center text-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-5xl md:text-7xl font-bold leading-none mb-6 tracking-tighter"><?= htmlspecialchars($json['hero']['h1'] ?? '') ?></h1>
            <p class="text-2xl md:text-3xl mb-10 max-w-3xl mx-auto"><?= htmlspecialchars($json['hero']['p'] ?? '') ?></p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#order" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xl font-semibold px-10 py-6 rounded-3xl inline-flex items-center gap-3 transition shadow-xl">
                    <i class="fa-solid fa-broom"></i> <?= htmlspecialchars($json['hero']['button_order'] ?? '') ?>
                </a>
                <a href="tel:<?= htmlspecialchars($json['general']['phone'] ?? '') ?>" class="border-2 border-white hover:bg-white hover:text-gray-900 text-white text-xl font-semibold px-10 py-6 rounded-3xl inline-flex items-center gap-3 transition">
                    <i class="fa-solid fa-phone"></i> <?= htmlspecialchars($json['hero']['button_phone'] ?? '') ?>
                </a>
            </div>
            <div class="mt-16 text-sm uppercase tracking-widest"><?= htmlspecialchars($json['hero']['bottom_text'] ?? '') ?></div>
        </div>
    </section>

    <!-- SERVICES -->
    <section id="services" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <span class="bg-emerald-100 text-emerald-700 px-5 py-2 rounded-full text-sm font-semibold"><?= htmlspecialchars($json['services']['badge'] ?? '') ?></span>
                <h2 class="text-5xl font-bold mt-4"><?= htmlspecialchars($json['services']['h2'] ?? '') ?></h2>
                <p class="mt-6 max-w-3xl mx-auto text-xl text-gray-600"><?= htmlspecialchars($json['services']['p'] ?? '') ?></p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php foreach($json['services']['items'] as $item): ?>
                <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden card-hover">
                    <div class="h-56 bg-[url('<?= htmlspecialchars($item['image'] ?? '') ?>')] bg-cover service-img"></div>
                    <div class="p-8">
                        <h3 class="text-2xl font-semibold mb-3"><?= htmlspecialchars($item['title'] ?? '') ?></h3>
                        <p class="text-gray-600"><?= htmlspecialchars($item['text'] ?? '') ?></p>
                        <div class="mt-6 text-emerald-600 font-medium"><?= htmlspecialchars($item['footer'] ?? '') ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ADVANTAGES -->
    <section id="advantages" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <span class="bg-emerald-100 text-emerald-700 px-5 py-2 rounded-full text-sm font-semibold"><?= htmlspecialchars($json['advantages']['badge'] ?? '') ?></span>
                <h2 class="text-5xl font-bold mt-4"><?= htmlspecialchars($json['advantages']['h2'] ?? '') ?></h2>
                <p class="mt-6 max-w-2xl mx-auto text-xl text-gray-600"><?= htmlspecialchars($json['advantages']['p'] ?? '') ?></p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach($json['advantages']['items'] as $adv): ?>
                <div class="bg-white p-8 rounded-3xl card-hover">
                    <div class="text-5xl mb-6"><?= $adv['emoji'] ?? '' ?></div>
                    <h3 class="text-2xl font-semibold mb-3"><?= htmlspecialchars($adv['title'] ?? '') ?></h3>
                    <p class="text-gray-600"><?= htmlspecialchars($adv['text'] ?? '') ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- HOW WE WORK -->
    <section id="how" class="py-24 bg-emerald-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <span class="bg-white px-6 py-2 rounded-full text-emerald-700 font-semibold"><?= htmlspecialchars($json['how']['badge'] ?? '') ?></span>
                <h2 class="text-5xl font-bold mt-4"><?= htmlspecialchars($json['how']['h2'] ?? '') ?></h2>
                <p class="mt-6 max-w-xl mx-auto text-gray-600"><?= htmlspecialchars($json['how']['p'] ?? '') ?></p>
            </div>
            <div class="grid md:grid-cols-4 gap-8">
                <?php foreach($json['how']['steps'] as $step): ?>
                <div class="text-center">
                    <div class="w-20 h-20 mx-auto bg-emerald-600 text-white rounded-2xl flex items-center justify-center text-4xl mb-6"><?= $step['num'] ?? '' ?></div>
                    <h3 class="font-semibold text-xl"><?= htmlspecialchars($step['title'] ?? '') ?></h3>
                    <p class="mt-3 text-gray-600"><?= htmlspecialchars($step['text'] ?? '') ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- GALLERY -->
    <section id="gallery" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <span class="bg-emerald-100 text-emerald-700 px-5 py-2 rounded-full text-sm font-semibold"><?= htmlspecialchars($json['gallery']['badge'] ?? '') ?></span>
                <h2 class="text-5xl font-bold mt-4"><?= htmlspecialchars($json['gallery']['h2'] ?? '') ?></h2>
                <p class="mt-6 max-w-xl mx-auto text-gray-600"><?= htmlspecialchars($json['gallery']['p'] ?? '') ?></p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <?php foreach($json['gallery']['images'] as $img): ?>
                <img src="<?= htmlspecialchars($img['url'] ?? '') ?>" alt="<?= htmlspecialchars($img['alt'] ?? '') ?>" class="gallery-img rounded-3xl shadow-lg w-full h-full object-cover">
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- REVIEWS -->
    <section id="reviews" class="py-24 bg-emerald-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <span class="text-emerald-600 font-semibold"><?= htmlspecialchars($json['reviews']['badge'] ?? '') ?></span>
                    <h2 class="text-5xl font-bold"><?= htmlspecialchars($json['reviews']['h2'] ?? '') ?></h2>
                </div>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <?php foreach($json['reviews']['items'] as $rev): ?>
                <div class="bg-white border border-gray-100 p-8 rounded-3xl">
                    <div class="flex text-yellow-400 mb-4"><?= $rev['stars'] ?? '' ?></div>
                    <p class="italic">"<?= htmlspecialchars($rev['text'] ?? '') ?>"</p>
                    <div class="mt-8 flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-200 rounded-full"></div>
                        <div><div class="font-semibold"><?= htmlspecialchars($rev['name'] ?? '') ?></div><div class="text-sm text-gray-500"><?= htmlspecialchars($rev['info'] ?? '') ?></div></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- SEO TEXT -->
    <section class="py-20 bg-white border-t border-b">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-8"><?= htmlspecialchars($json['seo_text']['h2'] ?? '') ?></h2>
            <p class="text-lg text-gray
