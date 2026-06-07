<?php
require_once 'partials/db.php';
require_once 'partials/header.php';

$stmt = $pdo->query("SELECT * FROM items ORDER BY id ASC");
$cars = $stmt->fetchAll();
$total = count($cars);

$brands = array_unique(array_column($cars, 'manufacturer'));
sort($brands);
?>

<div class="py-5 bg-light min-vh-100">
  <div class="container">

    <div class="text-center mb-5">
      <h1 class="display-4 fw-bold mb-3">Каталог Ретро Автомобилей</h1>
      <p class="fs-5 text-muted" style="max-width:700px; margin:0 auto;">
        Эксклюзивная коллекция из <?= $total ?> классических автомобилей 50–60-х годов.
      </p>
    </div>

    <!-- ФИЛЬТРЫ -->
    <div class="card border-2 mb-4 shadow-sm">
      <div class="card-body">
        <div class="row g-3 align-items-end">
          <div class="col-md-4">
            <label class="form-label fw-semibold">
              <i class="bi bi-search me-1 text-warning"></i>Поиск
            </label>
            <input type="text" id="searchInput" class="form-control"
                   placeholder="Название или марка..." oninput="filterCars()">
          </div>
          <div class="col-md-3">
            <label class="form-label fw-semibold">
              <i class="bi bi-funnel me-1 text-warning"></i>Марка
            </label>
            <select id="brandFilter" class="form-select" onchange="filterCars()">
              <option value="">Все</option>
              <?php foreach ($brands as $b): ?>
              <option value="<?= htmlspecialchars($b) ?>"><?= htmlspecialchars($b) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-3">
            <label class="form-label fw-semibold">
              <i class="bi bi-sort-down me-1 text-warning"></i>Сортировка
            </label>
            <select id="sortFilter" class="form-select" onchange="filterCars()">
              <option value="">По умолчанию</option>
              <option value="price_asc">Цена: от низкой</option>
              <option value="price_desc">Цена: от высокой</option>
              <option value="year_desc">Год: новее</option>
              <option value="year_asc">Год: старше</option>
            </select>
          </div>
          <div class="col-md-2">
            <button class="btn btn-outline-secondary w-100" onclick="resetFilters()">
              <i class="bi bi-x-circle me-1"></i>Сброс
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Счётчик результатов -->
    <div class="d-flex justify-content-between align-items-center mb-3">
      <p class="text-muted mb-0">
        Найдено: <strong id="resultCount"><?= $total ?></strong> из <?= $total ?> автомобилей
      </p>
      <span id="filterBadge" class="badge bg-warning text-dark d-none">Применены фильтры</span>
    </div>

    <!-- КАРТОЧКИ -->
    <div class="row g-4" id="carsGrid">
      <?php foreach ($cars as $car):
        $price_num = (int) preg_replace('/\D/', '', $car['price']);
      ?>
      <div class="col-md-6 col-lg-4 car-card"
           data-name="<?= strtolower(htmlspecialchars($car['name'])) ?>"
           data-brand="<?= htmlspecialchars($car['manufacturer']) ?>"
           data-price="<?= $price_num ?>"
           data-year="<?= (int)$car['year'] ?>">
        <div class="card car-card h-100">
          <div class="position-relative overflow-hidden" style="height:250px;">
            <img src="<?= htmlspecialchars($car['image']) ?>"
                 alt="<?= htmlspecialchars($car['name']) ?>"
                 class="car-image w-100 h-100">
            <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-3">
              <?= (int)$car['year'] ?>
            </span>
          </div>
          <div class="card-body">
            <h5 class="card-title mb-2"><?= htmlspecialchars($car['name']) ?></h5>
            <p class="card-text small text-muted mb-3"><?= htmlspecialchars($car['manufacturer']) ?></p>
            <div class="d-flex gap-3 small text-muted mb-3">
              <span><i class="bi bi-calendar me-1"></i><?= (int)$car['year'] ?></span>
              <span><i class="bi bi-speedometer me-1"></i><?= htmlspecialchars($car['power'] ?? '') ?></span>
            </div>
            <p class="small text-muted mb-3" style="overflow:hidden; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;">
              <?= htmlspecialchars($car['description']) ?>
            </p>
            <p class="price-badge mb-0"><?= htmlspecialchars($car['price']) ?></p>
          </div>
          <div class="card-footer bg-white border-0 p-3 d-flex gap-2">
            <a href="car.php?id=<?= (int)$car['id'] ?>" class="btn btn-warning flex-grow-1">Подробнее</a>
            <button class="btn btn-outline-warning add-to-cart" data-id="<?= (int)$car['id'] ?>" title="В корзину">
              <i class="bi bi-cart-plus"></i>
            </button>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Пустое состояние -->
    <div id="noResults" class="text-center py-5 d-none">
      <div class="empty-state-icon mx-auto mb-4"
           style="width:96px;height:96px;background:#fef3c7;border-radius:50%;display:flex;align-items:center;justify-content:center;">
        <i class="bi bi-search" style="font-size:3rem;color:#d97706;"></i>
      </div>
      <h4>Ничего не найдено</h4>
      <p class="text-muted">Попробуйте изменить параметры поиска</p>
      <button class="btn btn-warning" onclick="resetFilters()">Сбросить фильтры</button>
    </div>

  </div>
</div>

<script>
function resetFilters() {
  document.getElementById('searchInput').value = '';
  document.getElementById('brandFilter').value = '';
  document.getElementById('sortFilter').value = '';
  filterCars();
}
</script>

<?php require_once 'partials/footer.php'; ?>
