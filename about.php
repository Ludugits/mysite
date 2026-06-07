<?php
require_once 'partials/db.php';
require_once 'partials/header.php';
?>

<div>

<!-- HERO -->
<section class="position-relative d-flex align-items-center overflow-hidden" style="min-height:500px; background-image:url('https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?w=1920'); background-size:cover; background-position:center;">
  <div class="position-absolute top-0 start-0 w-100 h-100" style="background:linear-gradient(to right,rgba(0,0,0,.85),rgba(0,0,0,.5),transparent);"></div>
  <div class="position-relative container py-5" style="z-index:1;">
    <div style="max-width:620px;">
      <span class="badge bg-warning text-dark mb-3 px-3 py-2">С 2006 года</span>
      <h1 class="display-3 fw-bold text-white mb-4 lh-sm">О нас</h1>
      <p class="fs-5 mb-0" style="color:rgba(255,255,255,.65);">
        Более 20 лет мы занимаемся тем, что любим —<br>возвращаем к жизни легенды автопрома
      </p>
    </div>
  </div>
</section>

<!-- НАША ИСТОРИЯ -->
<section class="py-5 bg-white">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-md-6">
        <span class="badge bg-warning text-dark mb-3 px-3 py-2">Наша история</span>
        <h2 class="display-6 fw-bold mb-4">Два десятилетия страсти к классике</h2>
        <div class="text-muted lh-lg">
          <p>RetroAuto была основана в 2006 году группой энтузиастов, влюбленных в классические автомобили 50-х и 60-х годов. Начав с небольшой мастерской и нескольких автомобилей, мы выросли в ведущего дилера ретро автомобилей в регионе.</p>
          <p>Наша миссия — сохранить автомобильное наследие и дать возможность ценителям прикоснуться к истории. Каждый автомобиль тщательно отобран, отреставрирован и задокументирован.</p>
          <p class="mb-0">За годы работы мы помогли сотням коллекционеров найти автомобиль их мечты. От редких европейских родстеров до культовых американских маслкаров.</p>
        </div>
        <div class="d-flex gap-3 mt-4">
          <a href="catalog.php" class="btn btn-warning px-4">Смотреть каталог</a>
          <a href="order.php"   class="btn btn-outline-warning px-4">Оставить заявку</a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row g-3">
          <div class="col-6">
            <img src="https://images.unsplash.com/photo-1620861943958-fc98832e1713?w=600" class="img-fluid rounded-3 shadow" alt="" style="height:200px;object-fit:cover;width:100%;">
          </div>
          <div class="col-6 pt-4">
            <img src="https://images.unsplash.com/photo-1576425955345-f48eae74fc44?w=600" class="img-fluid rounded-3 shadow" alt="" style="height:200px;object-fit:cover;width:100%;">
          </div>
          <div class="col-6" style="margin-top:-2rem;">
            <img src="https://images.unsplash.com/photo-1650634179095-cac904c35b63?w=600" class="img-fluid rounded-3 shadow" alt="" style="height:200px;object-fit:cover;width:100%;">
          </div>
          <div class="col-6">
            <img src="https://images.unsplash.com/photo-1581163980256-d9581d08d401?w=600" class="img-fluid rounded-3 shadow" alt="" style="height:200px;object-fit:cover;width:100%;">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- НАШИ ЦЕННОСТИ -->
<section class="py-5" style="background:#f9fafb;">
  <div class="container">
    <div class="text-center mb-5">
      <span class="badge bg-warning text-dark mb-3 px-3 py-2">Что нами движет</span>
      <h2 class="display-6 fw-bold mb-3">Наши ценности</h2>
      <p class="text-muted mx-auto" style="max-width:600px;">Принципы, которыми мы руководствуемся в каждой сделке</p>
    </div>
    <div class="row g-4">
      <?php foreach ([
        ['bi-award',  '#fff7ed', '#d97706', 'Качество',   'Высочайший стандарт реставрации и подлинность каждого автомобиля — это не обещание, это наша репутация.'],
        ['bi-heart',  '#fdf2f8', '#db2777', 'Страсть',    'Мы делаем это не только ради бизнеса — каждый из нас по-настоящему влюблён в классические автомобили.'],
        ['bi-people', '#eff6ff', '#2563eb', 'Доверие',    'Полная прозрачность во всём: история автомобиля, документация, ценообразование — никаких сюрпризов.'],
        ['bi-tools',  '#f0fdf4', '#16a34a', 'Мастерство', 'Наши специалисты — профессионалы с десятилетиями опыта. Каждая деталь восстанавливается с любовью.'],
      ] as [$icon, $bg, $color, $title, $desc]): ?>
      <div class="col-md-6 col-lg-3">
        <div class="card border-0 h-100 shadow-sm" style="border-radius:16px; overflow:hidden;">
          <div class="card-body p-4">
            <div class="mb-3 d-flex align-items-center justify-content-center rounded-3"
                 style="width:56px;height:56px;background:<?= $bg ?>;color:<?= $color ?>;font-size:1.6rem;">
              <i class="bi <?= $icon ?>"></i>
            </div>
            <h5 class="fw-bold mb-2"><?= $title ?></h5>
            <p class="text-muted small mb-0" style="line-height:1.7;"><?= $desc ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- СТАТИСТИКА -->
<section class="py-5 position-relative overflow-hidden"
  style="background-image:url('https://images.unsplash.com/photo-1563720360172-67b8f3dce741?w=1920'); background-size:cover; background-position:center;">
  <div class="position-absolute top-0 start-0 w-100 h-100" style="background:rgba(28,25,23,.88);"></div>
  <div class="position-relative container py-3" style="z-index:1;">
    <div class="text-center mb-5">
      <h2 class="display-6 fw-bold text-white mb-2">RetroAuto в цифрах</h2>
      <p style="color:rgba(255,255,255,.5);">Результаты, которыми мы гордимся</p>
    </div>
    <div class="row g-4 text-center">
      <?php foreach ([
        ['20+',  'Лет опыта',                'bi-calendar-check', '#d97706'],
        ['150+', 'Проданных автомобилей',     'bi-car-front',      '#22c55e'],
        ['30+',  'Автомобилей в коллекции',   'bi-grid',           '#3b82f6'],
        ['15',   'Специалистов в команде',    'bi-people',         '#a855f7'],
      ] as [$num, $label, $icon, $color]): ?>
      <div class="col-md-3 col-6">
        <div class="p-4 rounded-3" style="background:rgba(255,255,255,.05); border:1px solid rgba(255,255,255,.1);">
          <div class="mb-2" style="font-size:2rem; color:<?= $color ?>;"><i class="bi <?= $icon ?>"></i></div>
          <div class="display-5 fw-bold text-white mb-1"><?= $num ?></div>
          <div class="small" style="color:rgba(255,255,255,.55);"><?= $label ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- КАК НАС НАЙТИ -->
<section class="py-5 bg-white">
  <div class="container">
    <div class="text-center mb-5">
      <span class="badge bg-warning text-dark mb-3 px-3 py-2">Контакты</span>
      <h2 class="display-6 fw-bold mb-2">Как нас найти</h2>
      <p class="text-muted">Мы всегда рады видеть вас в нашем шоуруме</p>
    </div>
    <div class="row g-4 mx-auto" style="max-width:900px;">
      <?php foreach ([
        ['bi-geo-alt',   '#fff7ed', '#d97706', 'Адрес',   'ул. Автомобильная, 15<br>Москва, 123456'],
        ['bi-telephone', '#eff6ff', '#2563eb', 'Телефон', '+7 (495) 123-45-67<br>Пн-Пт: 10:00 – 19:00'],
        ['bi-envelope',  '#f0fdf4', '#16a34a', 'Email',   'info@retroauto.ru<br>sales@retroauto.ru'],
      ] as [$icon, $bg, $color, $title, $text]): ?>
      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 text-center p-2" style="border-radius:16px;">
          <div class="card-body p-4">
            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle"
                 style="width:64px;height:64px;background:<?= $bg ?>;color:<?= $color ?>;font-size:1.8rem;">
              <i class="bi <?= $icon ?>"></i>
            </div>
            <h5 class="fw-bold mb-3"><?= $title ?></h5>
            <p class="text-muted small mb-0" style="line-height:1.8;"><?= $text ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

</div>

<?php require_once 'partials/footer.php'; ?>
