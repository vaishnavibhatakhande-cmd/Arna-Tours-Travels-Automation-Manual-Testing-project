<?php

declare(strict_types=1);

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/models/Vehicle.php';

$vehicles = (new Vehicle())->all(null, 'AVAILABLE');

sendSecurityHeaders();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Our Fleet | Arna Tour & Travels</title>
<link rel="icon" href="assets/img/favicon.png" type="image/png">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<style>body{font-family:'Plus Jakarta Sans',sans-serif}.fleet-card{transition:.35s ease}.fleet-card:hover{transform:translateY(-6px);box-shadow:0 24px 60px rgba(19,4,36,.12)}.fleet-image{height:250px;background:linear-gradient(135deg,#f7f3fc,#fff);display:flex;align-items:center;justify-content:center}.fleet-image img{width:100%;height:100%;object-fit:contain;padding:28px}</style>
</head>
<body class="bg-[#f7f5fa] text-[#16092b]">
<header class="sticky top-0 z-50 bg-[#130424]/95 backdrop-blur border-b border-white/10"><div class="max-w-7xl mx-auto px-6 lg:px-14 h-20 flex items-center justify-between"><a href="index.php" class="text-white text-xl font-extrabold">ARNA<span class="text-[#9d5eff]">.</span></a><nav class="hidden md:flex items-center gap-8 text-sm text-white/75"><a href="index.php#hero">Home</a><a href="index.php#services">Services</a><a href="vehicles.php" class="text-white">Our Fleet</a><a href="index.php#booking">Book a Ride</a></nav><a href="index.php#booking" class="rounded-full bg-white px-5 py-2.5 text-xs font-bold uppercase tracking-wider">Book a Ride →</a></div></header>
<main>
<section class="bg-[#130424] text-white px-6 lg:px-14 py-24"><div class="max-w-7xl mx-auto"><p class="text-xs font-bold uppercase tracking-[.25em] text-[#9d5eff]">Arna Fleet</p><h1 class="mt-4 text-5xl md:text-7xl font-extrabold tracking-tight">Travel in comfort.<br><span class="text-[#9d5eff]">Choose your ride.</span></h1><p class="mt-6 max-w-2xl text-white/60 leading-relaxed">Explore the vehicles currently listed by Arna Tour & Travels. Fleet availability and specifications are managed from the admin panel.</p></div></section>
<section class="px-6 lg:px-14 py-20"><div class="max-w-7xl mx-auto"><div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-7">
<?php foreach($vehicles as $vehicle): ?><article class="fleet-card overflow-hidden rounded-3xl bg-white border border-purple-100 shadow-sm"><div class="fleet-image"><?php if(!empty($vehicle['image'])): ?><img src="<?= e($vehicle['image']) ?>" alt="<?= e($vehicle['vehicle_name']) ?>"><?php else: ?><div class="text-6xl text-[#8b4df5]"><i class="ri-car-line"></i>🚕</div><?php endif; ?></div><div class="p-7"><div class="flex items-center justify-between gap-3"><h2 class="text-2xl font-extrabold"><?= e($vehicle['vehicle_name']) ?></h2><span class="rounded-full bg-purple-50 px-3 py-1 text-xs font-bold text-[#8b4df5]"><?= (int)$vehicle['seating_capacity'] ?> Seats</span></div><p class="mt-2 text-sm font-semibold text-[#8b4df5]"><?= e($vehicle['vehicle_type']) ?: 'Travel Vehicle' ?></p><p class="mt-4 text-sm leading-relaxed text-gray-500"><?= e($vehicle['description']) ?: 'Comfortable travel for local, outstation and tour journeys.' ?></p><div class="mt-6 flex items-center justify-between"><span class="text-xs font-bold uppercase tracking-wider text-emerald-600">Available</span><a href="index.php#booking" class="text-sm font-bold text-[#16092b]">Book this ride →</a></div></div></article><?php endforeach; ?>
<?php if(!$vehicles): ?><div class="sm:col-span-2 lg:col-span-3 rounded-3xl bg-white p-12 text-center text-gray-500">Fleet vehicles will appear here once they are added from the admin panel.</div><?php endif; ?>
</div></div></section>
<section class="bg-white px-6 lg:px-14 py-20 border-t border-purple-100"><div class="max-w-4xl mx-auto text-center"><p class="text-xs font-bold uppercase tracking-[.25em] text-[#8b4df5]">Serving All India</p><h2 class="mt-4 text-4xl md:text-5xl font-extrabold">One travel partner for every journey.</h2><p class="mt-5 text-gray-500 leading-relaxed">From local taxi rides to outstation travel and travel booking assistance, Arna Tour & Travels can be positioned as a single point of contact for journeys across India.</p><a href="index.php#booking" class="inline-flex mt-8 rounded-full bg-[#130424] text-white px-7 py-3.5 font-bold text-sm">Start Your Journey →</a></div></section>
</main>
<footer class="bg-[#130424] text-white px-6 lg:px-14 py-10"><div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4"><div><strong>ARNA TOUR & TRAVELS</strong><p class="mt-1 text-xs text-white/50">Premium travel services across India.</p></div><a href="index.php" class="text-sm text-white/70 hover:text-white">Back to website →</a></div></footer>
</body></html>
