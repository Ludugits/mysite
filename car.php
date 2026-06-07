<?php
require_once 'partials/db.php';
require_once 'partials/header.php';

$id   = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM items WHERE id = :id");
$stmt->execute([':id' => $id]);
$car  = $stmt->fetch();

if (!$car) {
    echo '<div class="container py-5 text-center"><h2>Автомобиль не найден</h2><a href="index.php" class="btn btn-warning mt-3">← В каталог</a></div>';
    require_once 'partials/footer.php';
    exit;
}

$features = json_decode($car['features'] ?? '[]', true);
?>

<main class="py-5 bg-light min-vh-100">
  <div class="container">
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Главная</a></li>
        <li class="breadcrumb-item active"><?= htmlspecialchars($car['name']) ?></li>
      </ol>
    </nav>

    <div class="row g-5">
      <!-- Фото -->
      <div class="col-lg-6">
        <img src="<?= htmlspecialchars($car['image']) ?>"
             alt="<?= htmlspecialchars($car['name']) ?>"
             class="img-fluid rounded-3 shadow w-100"
             style="max-height: 420px; object-fit: cover;">
      </div>

      <!-- Информация -->
      <div class="col-lg-6">
        <div class="d-flex align-items-center gap-2 mb-2">
          <span class="badge bg-warning text-dark fs-6"><?= (int) $car['year'] ?></span>
          <span class="text-muted"><?= htmlspecialchars($car['manufacturer']) ?></span>
        </div>
        <h1 class="display-5 fw-bold mb-3"><?= htmlspecialchars($car['name']) ?></h1>
        <p class="lead text-muted mb-4"><?= htmlspecialchars($car['description']) ?></p>

        <!-- Характеристики -->
        <div class="card border-warning border-2 mb-4">
          <div class="card-header bg-warning bg-opacity-10 fw-semibold">
            <i class="bi bi-gear me-2"></i>Технические характеристики
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between">
              <span class="text-muted">Двигатель</span><strong><?= htmlspecialchars($car['engine'] ?? '—') ?></strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span class="text-muted">Мощность</span><strong><?= htmlspecialchars($car['power'] ?? '—') ?></strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span class="text-muted">Трансмиссия</span><strong><?= htmlspecialchars($car['transmission'] ?? '—') ?></strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span class="text-muted">Цвет</span><strong><?= htmlspecialchars($car['color'] ?? '—') ?></strong>
            </li>
          </ul>
        </div>

        <!-- Особенности -->
        <?php if (!empty($features)): ?>
        <div class="mb-4">
          <h5 class="fw-semibold mb-2">Особенности</h5>
          <div class="d-flex flex-wrap gap-2">
            <?php foreach ($features as $f): ?>
            <span class="badge rounded-pill" style="background: var(--ra-gold); color:#fff; font-size:.85rem;">
              <i class="bi bi-check-circle me-1"></i><?= htmlspecialchars($f) ?>
            </span>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

        <!-- Цена и кнопки -->
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
          <span class="display-6 fw-bold" style="color: var(--ra-gold);"><?= htmlspecialchars($car['price']) ?></span>
          <a href="order.php?car_id=<?= $car['id'] ?>" class="btn btn-warning btn-lg px-4">
            <i class="bi bi-send me-2"></i>Оставить заявку
          </a>
        </div>
      </div>
    </div>

    <div class="mt-4">
      <a href="index.php" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Вернуться в каталог
      </a>
    </div>
  </div>
</main>

<?php require_once 'partials/footer.php'; ?>
