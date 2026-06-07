<?php
require_once 'partials/db.php';
require_once 'partials/header.php';

$cart  = $_SESSION['cart'] ?? [];
$items = array_values($cart);
$total = array_sum(array_map(fn($i) => (int) preg_replace('/\D/', '', $i['price']) * $i['quantity'], $items));
$count = array_sum(array_column($items, 'quantity'));

function plural($n, $one, $few, $many) {
  $n = abs($n) % 100;
  $n1 = $n % 10;
  if ($n > 10 && $n < 20) return $many;
  if ($n1 > 1 && $n1 < 5)  return $few;
  if ($n1 == 1)             return $one;
  return $many;
}
?>

<div class="container py-4 min-vh-100">

<?php if (empty($items)): ?>
  <!-- ПУСТАЯ КОРЗИНА -->
  <div class="text-center mx-auto" style="max-width:500px; padding-top:5rem;">
    <div class="mx-auto mb-4 d-flex align-items-center justify-content-center rounded-circle"
         style="width:96px;height:96px;background:#fef3c7;">
      <i class="bi bi-cart3" style="font-size:3rem;color:#d97706;"></i>
    </div>
    <h2 class="display-6 mb-3">Корзина пуста</h2>
    <p class="text-muted mb-4">Вы ещё не добавили ни одного автомобиля в корзину</p>
    <a href="catalog.php" class="btn btn-warning btn-lg">Перейти в каталог</a>
  </div>

<?php else: ?>
  <!-- ЗАГОЛОВОК -->
  <div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
      <h1 class="display-5 mb-2">Корзина</h1>
      <p class="text-muted mb-0">
        <?= $count ?> <?= plural($count, 'автомобиль', 'автомобиля', 'автомобилей') ?>
      </p>
    </div>
    <button class="btn btn-outline-danger" id="clearCartBtn">
      <i class="bi bi-trash me-2"></i>Очистить корзину
    </button>
  </div>

  <div class="row g-4">
    <!-- СПИСОК -->
    <div class="col-lg-8">
      <div class="d-flex flex-column gap-3" id="cartItems">
        <?php foreach ($items as $item): ?>
        <div class="card border-2 cart-item" id="cart-item-<?= $item['id'] ?>"
             style="transition:opacity .3s;">
          <div class="card-body p-3">
            <div class="d-flex gap-3">
              <div class="flex-shrink-0"
                   style="width:120px;height:90px;background-image:url('<?= htmlspecialchars($item['image']) ?>');background-size:cover;background-position:center;border-radius:.5rem;">
              </div>
              <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start mb-2">
                  <div>
                    <h5 class="mb-1"><?= htmlspecialchars($item['name']) ?></h5>
                    <p class="small text-muted mb-0">
                      <?= htmlspecialchars($item['manufacturer']) ?> • <?= (int)$item['year'] ?>
                    </p>
                  </div>
                  <button class="btn btn-sm btn-outline-danger remove-btn" data-id="<?= $item['id'] ?>">
                    <i class="bi bi-trash"></i>
                  </button>
                </div>
                <p class="fs-4 fw-bold mb-0 mt-2" style="color:#d97706;">
                  <?= htmlspecialchars($item['price']) ?>
                </p>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- ИТОГО -->
    <div class="col-lg-4">
      <div class="card border-2 sticky-top" style="top:5rem;" id="summaryCard">
        <div class="card-body">
          <h3 class="h5 mb-4">Итого</h3>
          <div class="mb-4">
            <div class="d-flex justify-content-between text-muted mb-2">
              <span>Автомобилей:</span>
              <span id="summaryCount"><?= $count ?></span>
            </div>
            <hr>
            <div class="d-flex justify-content-between align-items-center">
              <span class="fs-5">Общая сумма:</span>
              <span class="fs-4 fw-bold" style="color:#d97706;" id="summaryTotal">
                <?= number_format($total, 0, '', ' ') ?> €
              </span>
            </div>
          </div>
          <a href="order.php" class="btn btn-warning btn-lg w-100 mb-3">
            <i class="bi bi-credit-card me-2"></i>Оформить заказ
          </a>
          <a href="catalog.php" class="btn btn-outline-warning w-100">
            <i class="bi bi-arrow-left me-2"></i>Продолжить покупки
          </a>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

</div>

<script>
// Удалить один товар
document.querySelectorAll('.remove-btn').forEach(btn => {
  btn.addEventListener('click', async () => {
    const id = btn.dataset.id;
    const fd = new FormData();
    fd.append('action', 'remove');
    fd.append('car_id', id);
    const res  = await fetch('cart_action.php', { method: 'POST', body: fd });
    const data = await res.json();
    if (data.success) {
      const el = document.getElementById('cart-item-' + id);
      el.style.opacity = '0';
      setTimeout(() => { el.remove(); updateBadge(data.count); checkEmpty(); }, 300);
    }
  });
});

// Очистить корзину
document.getElementById('clearCartBtn')?.addEventListener('click', async () => {
  const fd = new FormData();
  fd.append('action', 'clear');
  const res  = await fetch('cart_action.php', { method: 'POST', body: fd });
  const data = await res.json();
  if (data.success) { location.reload(); }
});

function updateBadge(count) {
  const badge = document.getElementById('cartBadge');
  if (!badge) return;
  if (count > 0) { badge.textContent = count; badge.classList.remove('d-none'); }
  else badge.classList.add('d-none');
}

function checkEmpty() {
  const remaining = document.querySelectorAll('.cart-item');
  if (remaining.length === 0) location.reload();
}
</script>

<?php require_once 'partials/footer.php'; ?>
