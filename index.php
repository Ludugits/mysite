<?php
require_once 'partials/db.php';
require_once 'partials/header.php';

$stmt = $pdo->query("SELECT * FROM items ORDER BY id ASC");
$cars = $stmt->fetchAll();
$featured = array_slice($cars, 0, 3);
?>

<div class="d-flex flex-column min-vh-100">

<!-- HERO SECTION -->
<section
  class="position-relative d-flex align-items-center overflow-hidden"
  style="min-height:90vh; background-image:url('https://images.unsplash.com/photo-1697196180794-be968e5c906f?w=1920'); background-size:cover; background-position:center;">

  <div class="position-absolute top-0 start-0 w-100 h-100"
       style="background: linear-gradient(to right, rgba(0,0,0,0.8), rgba(0,0,0,0.5), transparent);"></div>

  <div class="position-relative container" style="z-index:1;">
    <div style="max-width:600px;">
      <span class="badge bg-warning text-dark mb-3 px-3 py-2">Коллекция 2026</span>
      <h1 class="display-3 fw-bold text-white mb-4 lh-sm">
        Легенды <br><span class="text-warning">Автопрома</span>
      </h1>
      <p class="fs-5 mb-4" style="color:rgba(255,255,255,.5);">
        Тщательно отреставрированные классические автомобили 50-х и 60-х годов. Каждый экземпляр — живая история с полной документацией.
      </p>
      <div class="d-flex gap-3 flex-wrap">
        <a href="catalog.php" class="btn btn-warning btn-lg px-4">
          Смотреть каталог <i class="bi bi-chevron-right ms-2"></i>
        </a>
        <a href="order.php" class="btn btn-outline-light btn-lg px-4">Оставить заявку</a>
      </div>
    </div>
  </div>

  <!-- Stats bar -->
  <div class="position-absolute bottom-0 start-0 w-100"
       style="background:rgba(0,0,0,0.6); backdrop-filter:blur(10px);">
    <div class="container">
      <div class="row py-3">
        <div class="col-4 text-center py-2">
          <p class="display-6 text-warning mb-0"><span data-counter="150">0</span>+</p>
          <p class="small mb-0" style="color:rgba(255,255,255,.5);">Автомобилей продано</p>
        </div>
        <div class="col-4 text-center py-2 border-start border-end border-secondary">
          <p class="display-6 text-warning mb-0"><span data-counter="20">0</span>+</p>
          <p class="small mb-0" style="color:rgba(255,255,255,.5);">Лет на рынке</p>
        </div>
        <div class="col-4 text-center py-2">
          <p class="display-6 text-warning mb-0"><span data-counter="95">0</span>%</p>
          <p class="small mb-0" style="color:rgba(255,255,255,.5);">Довольных клиентов</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ПОЧЕМУ ВЫБИРАЮТ НАС -->
<section class="py-5 bg-white">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="display-5 mb-3">Почему выбирают нас</h2>
      <p class="text-muted" style="max-width:600px; margin:0 auto;">
        Более двух десятилетий мы соединяем ценителей с шедеврами классического автопрома
      </p>
    </div>
    <div class="row g-4">
      <?php foreach ([
        ['bi-award',       'Экспертность',      'Более 20 лет опыта в реставрации и продаже классических автомобилей'],
        ['bi-shield-check','Гарантия качества',  'Полная документация, история обслуживания и гарантия подлинности'],
        ['bi-car-front',   'Редкие экземпляры',  'Эксклюзивная коллекция автомобилей со всего мира'],
        ['bi-tools',       'Реставрация',        'Профессиональная реставрация с сохранением оригинальности'],
      ] as [$icon, $title, $desc]): ?>
      <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm feature-card">
          <div class="card-body text-center p-4">
            <div class="feature-icon mb-3"><i class="bi <?= $icon ?>"></i></div>
            <h5 class="card-title mb-3"><?= $title ?></h5>
            <p class="card-text small text-muted"><?= $desc ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ИЗБРАННЫЕ АВТОМОБИЛИ -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="d-flex justify-content-between align-items-end mb-4">
      <div>
        <h2 class="display-5 mb-2">Избранные автомобили</h2>
        <p class="text-muted">Лучшие экземпляры нашей коллекции</p>
      </div>
      <a href="catalog.php" class="d-none d-md-flex align-items-center text-decoration-none text-warning">
        Весь каталог <i class="bi bi-chevron-right ms-1"></i>
      </a>
    </div>
    <div class="row g-4">
      <?php foreach ($featured as $car): ?>
      <div class="col-md-6 col-lg-4">
        <div class="card car-card h-100">
          <div class="position-relative overflow-hidden" style="height:250px;">
            <img src="<?= htmlspecialchars($car['image']) ?>"
                 alt="<?= htmlspecialchars($car['name']) ?>"
                 class="car-image">
            <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-3">
              <?= (int)$car['year'] ?>
            </span>
          </div>
          <div class="card-body">
            <h5 class="card-title mb-1"><?= htmlspecialchars($car['name']) ?></h5>
            <p class="card-text small text-muted mb-3"><?= htmlspecialchars($car['manufacturer']) ?></p>
            <div class="d-flex gap-3 small text-muted mb-3">
              <div class="d-flex align-items-center gap-1">
                <i class="bi bi-calendar"></i><span><?= (int)$car['year'] ?></span>
              </div>
              <div class="d-flex align-items-center gap-1">
                <i class="bi bi-speedometer"></i><span><?= htmlspecialchars($car['power'] ?? '') ?></span>
              </div>
            </div>
            <p class="price-badge mb-3"><?= htmlspecialchars($car['price']) ?></p>
          </div>
          <div class="card-footer bg-white border-0 pb-3">
            <a href="car.php?id=<?= (int)$car['id'] ?>" class="btn btn-warning w-100">Подробнее</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="mt-4 text-center d-md-none">
      <a href="catalog.php" class="btn btn-outline-warning">Весь каталог</a>
    </div>
  </div>
</section>

<!-- CTA BANNER -->
<section
  class="position-relative py-5 overflow-hidden"
  style="background-image:url('https://images.unsplash.com/photo-1642948815603-2358193c3241?w=1920'); background-size:cover; background-position:center; min-height:400px;">
  <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-75"></div>
  <div class="position-relative container text-center py-5" style="z-index:10;">
    <h2 class="display-5 text-white mb-3">Готовы приобрести классику?</h2>
    <p class="fs-5 mb-4" style="color:rgba(255,255,255,.5); max-width:700px; margin:0 auto 2rem;">
      Оставьте заявку, и наши эксперты помогут вам выбрать идеальный ретро автомобиль из нашей коллекции
    </p>
    <div class="d-flex gap-3 justify-content-center flex-wrap">
      <a href="order.php"   class="btn btn-light btn-lg px-5">Оставить заявку</a>
      <a href="catalog.php" class="btn btn-outline-light btn-lg px-5">Смотреть каталог</a>
    </div>
  </div>
</section>

</div>

<?php require_once 'partials/footer.php'; ?>
