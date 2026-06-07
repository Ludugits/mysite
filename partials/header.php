<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RetroAuto — Ретро-автомобили</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root {
      --ra-gold:       #d97706;
      --ra-gold-hover: #b45309;
      --ra-gold-light: #fef3c7;
      --ra-dark:       #1c1917;
      --ra-dark-nav:   #111827;
      --ra-gray:       #78716c;
      --ra-bg-light:   #f9fafb;
    }
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
      color: #1f2937;
    }

    /* ШАПКА */
    .retro-header {
      background: #fff;
      box-shadow: 0 2px 8px rgba(0,0,0,.1);
      border-bottom: 2px solid var(--ra-gold-light);
      position: sticky; top: 0; z-index: 1030;
    }
    .retro-logo-img { border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,.15); transition: transform .2s; flex-shrink: 0; }
    .retro-logo-img:hover { transform: scale(1.08); }
    .retro-brand-name { font-weight: 700; font-size: 1.15rem; color: #1f2937; line-height: 1.2; }
    .retro-brand-sub  { font-size: .68rem; color: #6b7280; line-height: 1; }

    /* Ссылки меню */
    .retro-nav-link {
      display: inline-flex; align-items: center;
      padding: .45rem .8rem; border-radius: .375rem;
      font-size: .92rem; color: #374151; text-decoration: none;
      white-space: nowrap; transition: background-color .2s, color .2s;
    }
    .retro-nav-link:hover  { background: var(--ra-gold-light); color: var(--ra-gold); }
    .retro-nav-link.active { background: var(--ra-gold-light); color: var(--ra-gold-hover); font-weight: 600; }

    /* ФУТЕР */
    .retro-footer { background: var(--ra-dark-nav); color: #e5e7eb; }
    .retro-footer-link { color: #9ca3af; text-decoration: none; font-size: .9rem; transition: color .2s; }
    .retro-footer-link:hover { color: var(--ra-gold); text-decoration: underline; }

    /* КНОПКИ */
    .btn-warning { background-color: var(--ra-gold) !important; border-color: var(--ra-gold) !important; color: #fff !important; }
    .btn-warning:hover, .btn-warning:focus { background-color: var(--ra-gold-hover) !important; border-color: var(--ra-gold-hover) !important; color: #fff !important; }
    .btn-outline-warning { color: var(--ra-gold) !important; border-color: var(--ra-gold) !important; background: transparent !important; }
    .btn-outline-warning:hover { background: var(--ra-gold-light) !important; color: var(--ra-gold-hover) !important; }

    /* КАРТОЧКИ АВТО */
    .car-card { transition: transform .25s, box-shadow .25s, border-color .25s; border: 2px solid #e5e7eb !important; overflow: hidden; }
    .car-card:hover { transform: translateY(-4px); box-shadow: 0 14px 30px rgba(0,0,0,.12) !important; border-color: var(--ra-gold) !important; }
    .car-image { height: 250px; object-fit: cover; transition: transform .3s; display: block; width: 100%; }
    .car-card:hover .car-image { transform: scale(1.04); }
    .price-badge { font-size: 1.4rem; color: var(--ra-gold-hover); font-weight: 700; }

    /* КАРТОЧКИ ПРЕИМУЩЕСТВ */
    .feature-card { transition: transform .3s, box-shadow .3s; }
    .feature-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,.1) !important; }
    .feature-icon { font-size: 2.75rem; color: var(--ra-gold); line-height: 1; }

    /* ФОРМЫ */
    .form-control:focus, .form-select:focus { border-color: var(--ra-gold); box-shadow: 0 0 0 .2rem rgba(217,119,6,.2); }
    .form-check-input:checked { background-color: var(--ra-gold); border-color: var(--ra-gold); }

    /* АДАПТИВ */
    @media (max-width:767.98px) {
      .display-3 { font-size: 2.1rem; } .display-4 { font-size: 1.9rem; } .display-5 { font-size: 1.65rem; }
      .car-image { height: 200px; }
    }
  </style>
</head>
<body>

<?php
// Определяем текущую страницу для активного пункта меню
$current = basename($_SERVER['PHP_SELF']);
function navClass($file) {
  global $current;
  return $current === $file ? 'retro-nav-link active' : 'retro-nav-link';
}
?>

<header class="retro-header">
  <div class="container">
    <div class="d-flex align-items-center justify-content-between py-2 flex-wrap gap-2">

      <!-- Логотип -->
      <a href="index.php" class="d-flex align-items-center gap-2 text-decoration-none">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="44" height="44" class="retro-logo-img">
          <defs>
            <linearGradient id="raGrad" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" stop-color="#d97706"/>
              <stop offset="100%" stop-color="#b45309"/>
            </linearGradient>
          </defs>
          <rect width="64" height="64" rx="12" fill="url(#raGrad)"/>
          <path d="M18 36 C18 28 20 26 24 26 L38 26 C41 26 44 28 46 31 L50 31 C52 31 53 32 53 34 L53 37 C53 38 52 39 50 39 C49 35 44 35 43 39 L27 39 C26 35 21 35 20 39 L19 39 C18 39 18 38 18 36 Z" fill="none" stroke="white" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
          <circle cx="23.5" cy="39" r="3" fill="none" stroke="white" stroke-width="3.5"/>
          <circle cx="46.5" cy="39" r="3" fill="none" stroke="white" stroke-width="3.5"/>
        </svg>
        <div>
          <div class="retro-brand-name">RetroAuto</div>
          <div class="retro-brand-sub">Классика на колёсах</div>
        </div>
      </a>

      <!-- Меню -->
      <nav class="d-flex align-items-center gap-1 flex-wrap">
        <a href="index.php"   class="<?= navClass('index.php') ?>"><i class="bi bi-house me-1"></i>Главная</a>
        <a href="catalog.php" class="<?= navClass('catalog.php') ?>"><i class="bi bi-grid me-1"></i>Каталог</a>
        <a href="student.php" class="<?= navClass('student.php') ?>"><i class="bi bi-person me-1"></i>О себе</a>
        <a href="labs.php"    class="<?= navClass('labs.php') ?>"><i class="bi bi-list-check me-1"></i>Лабораторные</a>
        <a href="feedback.php" class="<?= navClass('feedback.php') ?>"><i class="bi bi-envelope me-1"></i>Обратная связь</a>
        <a href="about.php"   class="<?= navClass('about.php') ?>"><i class="bi bi-info-circle me-1"></i>О нас</a>
        <a href="order.php"   class="<?= navClass('order.php') ?>"><i class="bi bi-file-text me-1"></i>Заказать</a>
        <?php
          $cartCount = array_sum(array_column($_SESSION['cart'] ?? [], 'quantity'));
        ?>
        <a href="cart.php" class="position-relative retro-cart-btn ms-1 text-decoration-none">
          <i class="bi bi-cart3 me-1"></i>Корзина
          <?php if ($cartCount > 0): ?>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cartBadge">
            <?= $cartCount ?>
          </span>
          <?php else: ?>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none" id="cartBadge"></span>
          <?php endif; ?>
        </a>
      </nav>

    </div>
  </div>
</header>
