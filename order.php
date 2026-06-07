<?php
require_once 'partials/db.php';
require_once 'partials/header.php';

$cartItems = array_values($_SESSION['cart'] ?? []);
$hasCart   = !empty($cartItems);
$total     = array_sum(array_map(fn($i) => (int) preg_replace('/\D/', '', $i['price']) * $i['quantity'], $cartItems));

function plural($n, $one, $few, $many) {
  $n = abs($n) % 100; $n1 = $n % 10;
  if ($n > 10 && $n < 20) return $many;
  if ($n1 > 1 && $n1 < 5) return $few;
  if ($n1 == 1)            return $one;
  return $many;
}
$count = count($cartItems);
?>

<div class="py-5 bg-light min-vh-100">
  <div class="container">
    <div class="mx-auto" style="max-width:820px;">

      <div class="text-center mb-5">
        <h1 class="display-5 fw-bold mb-3">Оставить заявку</h1>
        <p class="fs-5 text-muted">Заполните форму, и наш специалист свяжется с вами для обсуждения деталей</p>
      </div>

      <!-- АВТОМОБИЛИ ИЗ КОРЗИНЫ -->
      <?php if ($hasCart): ?>
      <div class="card border-2 mb-4 shadow-sm" style="border-color:#d97706!important;">
        <div class="card-header d-flex align-items-center gap-2" style="background:#fff7ed;">
          <i class="bi bi-cart-check-fill text-warning fs-5"></i>
          <span class="fw-bold">
            <?= $count ?> <?= plural($count,'автомобиль','автомобиля','автомобилей') ?> в заявке
          </span>
        </div>
        <div class="card-body p-0">
          <ul class="list-group list-group-flush">
            <?php foreach ($cartItems as $idx => $item): ?>
            <li class="list-group-item px-4 py-3">
              <div class="d-flex align-items-center gap-3">
                <span class="badge rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                      style="width:28px;height:28px;background:#d97706;color:#fff;font-size:.8rem;">
                  <?= $idx + 1 ?>
                </span>
                <img src="<?= htmlspecialchars($item['image']) ?>"
                     style="width:64px;height:48px;object-fit:cover;border-radius:6px;flex-shrink:0;" alt="">
                <div class="flex-grow-1">
                  <div class="fw-semibold"><?= htmlspecialchars($item['name']) ?></div>
                  <div class="small text-muted"><?= htmlspecialchars($item['manufacturer']) ?> • <?= (int)$item['year'] ?></div>
                </div>
                <div class="fw-bold" style="color:#b45309;"><?= htmlspecialchars($item['price']) ?></div>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
          <?php if ($count > 1): ?>
          <div class="px-4 py-3 d-flex justify-content-between align-items-center bg-light border-top">
            <span class="fw-semibold text-muted">Общая сумма:</span>
            <span class="fs-5 fw-bold" style="color:#b45309;"><?= number_format($total, 0, '', ' ') ?> €</span>
          </div>
          <?php endif; ?>
        </div>
      </div>
      <?php else: ?>
      <div class="alert alert-warning mb-4">
        <i class="bi bi-info-circle me-2"></i>
        Корзина пуста. <a href="catalog.php" class="alert-link">Выберите автомобили в каталоге</a>.
      </div>
      <?php endif; ?>

      <!-- ФОРМА -->
      <div class="card border-2 shadow" style="border-color:#e5e7eb!important;">
        <div class="card-header bg-white border-bottom py-3">
          <h2 class="h4 mb-1">Форма заказа</h2>
          <p class="text-muted mb-0 small">Поля, отмеченные (*), обязательны</p>
        </div>
        <div class="card-body p-4">

          <form id="orderForm">
            <?php foreach ($cartItems as $item): ?>
            <input type="hidden" name="car_ids[]" value="<?= (int)$item['id'] ?>">
            <?php endforeach; ?>

            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <label class="form-label d-flex align-items-center gap-2">
                  <i class="bi bi-person text-warning"></i>Ваше имя *
                </label>
                <input type="text" name="name" class="form-control form-control-lg" placeholder="Иван Петров" required>
              </div>
              <div class="col-md-6">
                <label class="form-label d-flex align-items-center gap-2">
                  <i class="bi bi-telephone text-warning"></i>Телефон *
                </label>
                <input type="tel" name="phone" class="form-control form-control-lg" placeholder="+7 (999) 123-45-67" required>
              </div>
            </div>

            <div class="mb-4">
              <label class="form-label d-flex align-items-center gap-2">
                <i class="bi bi-envelope text-warning"></i>Email *
              </label>
              <input type="email" name="email" class="form-control form-control-lg" placeholder="ivan@example.com" required>
            </div>

            <div class="mb-4">
              <label class="form-label d-flex align-items-center gap-2">
                <i class="bi bi-chat-left-text text-warning"></i>Сообщение
              </label>
              <textarea name="message" class="form-control form-control-lg" rows="4"
                        placeholder="Дополнительные пожелания, вопросы..."></textarea>
            </div>

            <div class="mb-4 p-3 rounded" style="background:#fff7ed;">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="newsletter" id="newsletter">
                <label class="form-check-label" for="newsletter">
                  Хочу получать новости о новых поступлениях и специальных предложениях
                </label>
              </div>
            </div>

            <button type="submit" class="btn btn-warning btn-lg w-100 mb-3">
              <i class="bi bi-send me-2"></i>
              <?= $hasCart
                ? 'Отправить заявку на ' . $count . ' ' . plural($count,'автомобиль','автомобиля','автомобилей')
                : 'Отправить заявку' ?>
            </button>

            <?php if ($hasCart): ?>
            <a href="cart.php" class="btn btn-outline-secondary w-100 mb-3">
              <i class="bi bi-arrow-left me-2"></i>Вернуться в корзину
            </a>
            <?php endif; ?>

            <p class="small text-muted text-center mb-0">
              Нажимая «Отправить заявку», вы соглашаетесь с обработкой персональных данных
            </p>
          </form>
        </div>
      </div>

      <!-- ТАБЛИЦА ЗАЯВОК (GET Ajax) -->
      <div class="card border-2 shadow-sm mt-4">
        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
          <h3 class="h5 mb-0">
            <i class="bi bi-list-ul text-warning me-2"></i>Все заявки
            <span id="feedbackCount" class="badge bg-warning text-dark ms-2">0</span>
          </h3>
          <button id="refreshBtn" class="btn btn-outline-warning btn-sm">
            <i class="bi bi-arrow-clockwise me-1"></i>Обновить
          </button>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Имя</th>
                  <th>Email</th>
                  <th>Телефон</th>
                  <th>Дата</th>
                </tr>
              </thead>
              <tbody id="feedbackBody">
                <tr>
                  <td colspan="5" class="text-center text-muted py-4">
                    <i class="bi bi-inbox me-2"></i>Загрузка…
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer text-muted small">
          <i class="bi bi-clock me-1"></i>Автообновление каждые 30 секунд
        </div>
      </div>

      <!-- КОНТАКТЫ -->
      <div class="card mt-4 border-2 shadow-sm" style="border-color:#d97706!important;">
        <div class="card-body">
          <h3 class="h5 fw-bold mb-3">Другие способы связи</h3>
          <div class="row g-2">
            <div class="col-sm-4"><p class="d-flex gap-2 mb-0"><i class="bi bi-telephone text-warning"></i>+7 (495) 123-45-67</p></div>
            <div class="col-sm-4"><p class="d-flex gap-2 mb-0"><i class="bi bi-envelope text-warning"></i>info@retroauto.ru</p></div>
            <div class="col-sm-4"><p class="d-flex gap-2 mb-0"><i class="bi bi-clock text-warning"></i>Пн–Пт 10:00–19:00</p></div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Bootstrap Modal — успешная отправка -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header border-0 pb-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center px-5 pb-2">
        <div class="mb-3" style="font-size:4rem;">✅</div>
        <h2 class="h4 fw-bold mb-2">Заявка отправлена!</h2>
        <p class="text-muted mb-1" id="modalMessage"></p>
        <p class="small text-muted" id="modalId"></p>
      </div>
      <div class="modal-footer border-0 justify-content-center pb-4">
        <button type="button" class="btn btn-warning px-5" data-bs-dismiss="modal">Закрыть</button>
        <a href="catalog.php" class="btn btn-outline-warning px-5">В каталог</a>
      </div>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
// ═══ МЕТОД GET — загрузка списка заявок ═══
function loadFeedback() {
  $.get('ajax.php', function(response) {
    if (!response.success) return;
    $('#feedbackCount').text(response.count);

    if (response.data.length === 0) {
      $('#feedbackBody').html('<tr><td colspan="5" class="text-center text-muted py-4">Заявок пока нет</td></tr>');
      return;
    }

    let html = '';
    response.data.forEach(function(r) {
      const date = new Date(r.created_at).toLocaleString('ru-RU');
      html += `<tr>
        <td class="text-muted small">${r.id}</td>
        <td class="fw-semibold">${$('<div>').text(r.name).html()}</td>
        <td class="text-muted small">${$('<div>').text(r.email).html()}</td>
        <td class="text-muted small">${$('<div>').text(r.phone).html()}</td>
        <td class="text-muted small">${date}</td>
      </tr>`;
    });
    $('#feedbackBody').html(html);
  }, 'json');
}

// Загрузить при открытии страницы
loadFeedback();

// Обновить по кнопке
$('#refreshBtn').on('click', loadFeedback);

// Автообновление каждые 30 секунд
setInterval(loadFeedback, 30000);


// ═══ МЕТОД POST — отправка формы через jQuery.ajax ═══
$('#orderForm').on('submit', function(e) {
  e.preventDefault();

  const $btn = $(this).find('button[type=submit]');
  $btn.prop('disabled', true)
      .html('<span class="spinner-border spinner-border-sm me-2"></span>Отправка…');

  $.ajax({
    url:         'ajax.php',
    method:      'POST',
    data:        new FormData(this),
    dataType:    'json',
    processData: false,
    contentType: false,

    success: function(data) {
      if (data.success) {
        // Показываем Bootstrap Modal
        $('#modalMessage').text(data.message);
        $('#modalId').text('№ заявки: ' + data.feedback_id);
        new bootstrap.Modal(document.getElementById('successModal')).show();

        // Сброс формы
        document.getElementById('orderForm').reset();

        // Очищаем корзину
        $.post('cart_action.php', { action: 'clear' });
        $('#cartBadge').addClass('d-none');

        // Обновляем таблицу заявок
        loadFeedback();

        $btn.html('<i class="bi bi-check-circle me-2"></i>Заявка отправлена');
      } else {
        alert('Ошибка: ' + data.message);
        $btn.prop('disabled', false)
            .html('<i class="bi bi-send me-2"></i>Отправить заявку');
      }
    },

    error: function() {
      alert('Произошла ошибка. Попробуйте позже.');
      $btn.prop('disabled', false)
          .html('<i class="bi bi-send me-2"></i>Отправить заявку');
    }
  });
});
</script>

<?php require_once 'partials/footer.php'; ?>