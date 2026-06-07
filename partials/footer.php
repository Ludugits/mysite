<footer class="retro-footer mt-auto py-4">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4">
        <div class="d-flex align-items-center gap-2 mb-3">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="36" height="36" style="border-radius:8px;flex-shrink:0;">
            <defs><linearGradient id="raGrad2" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#d97706"/><stop offset="100%" stop-color="#b45309"/></linearGradient></defs>
            <rect width="64" height="64" rx="12" fill="url(#raGrad2)"/>
            <path d="M18 36 C18 28 20 26 24 26 L38 26 C41 26 44 28 46 31 L50 31 C52 31 53 32 53 34 L53 37 C53 38 52 39 50 39 C49 35 44 35 43 39 L27 39 C26 35 21 35 20 39 L19 39 C18 39 18 38 18 36 Z" fill="none" stroke="white" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
            <circle cx="23.5" cy="39" r="3" fill="none" stroke="white" stroke-width="3.5"/>
            <circle cx="46.5" cy="39" r="3" fill="none" stroke="white" stroke-width="3.5"/>
          </svg>
          <div>
            <div class="retro-brand-name" style="color:#fff;">RetroAuto</div>
            <div class="retro-brand-sub" style="color:rgba(255,255,255,.5);">© <?= date('Y') ?> Все права защищены</div>
          </div>
        </div>
        <p class="small mb-0" style="color:rgba(255,255,255,.5);">Коллекция редких ретро-автомобилей 50–60-х годов.</p>
      </div>
      <div class="col-md-4">
        <h6 class="text-white fw-bold mb-3">Навигация</h6>
        <ul class="list-unstyled mb-0">
          <li class="mb-1"><a href="index.php"   class="retro-footer-link">Главная</a></li>
          <li class="mb-1"><a href="catalog.php" class="retro-footer-link">Каталог</a></li>
          <li class="mb-1"><a href="about.php"   class="retro-footer-link">О нас</a></li>
          <li class="mb-1"><a href="order.php"   class="retro-footer-link">Заказать</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h6 class="text-white fw-bold mb-3">Контакты</h6>
        <ul class="list-unstyled mb-0 small" style="color:rgba(255,255,255,.5);">
          <li class="mb-2"><i class="bi bi-telephone me-2 text-warning"></i>+7 (495) 123-45-67</li>
          <li class="mb-2"><i class="bi bi-envelope me-2 text-warning"></i>info@retroauto.ru</li>
          <li class="mb-2"><i class="bi bi-geo-alt me-2 text-warning"></i>ул. Автомобильная, 15, Москва</li>
          <li><i class="bi bi-clock me-2 text-warning"></i>Пн–Пт: 10:00–19:00</li>
        </ul>
      </div>
    </div>
    <hr class="border-secondary mt-4 mb-3">
    <p class="text-center small mb-0" style="color:rgba(255,255,255,.4);">
      Разработано на PHP с использованием Bootstrap 5
    </p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Анимация счётчиков
function animateCounter(el, target, duration) {
  let start = 0;
  const step = Math.ceil(target / (duration / 16));
  const timer = setInterval(() => {
    start += step;
    if (start >= target) { el.textContent = target; clearInterval(timer); }
    else el.textContent = start;
  }, 16);
}
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[data-counter]').forEach(el => {
    animateCounter(el, parseInt(el.dataset.counter), 1500);
  });
});

// Корзина — добавление через AJAX
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.add-to-cart').forEach(btn => {
    btn.addEventListener('click', async () => {
      const id = btn.dataset.id;
      const fd = new FormData();
      fd.append('action', 'add');
      fd.append('car_id', id);
      const res  = await fetch('cart_action.php', { method: 'POST', body: fd });
      const data = await res.json();
      if (data.success) {
        // Обновляем бейдж корзины
        const badge = document.getElementById('cartBadge');
        if (badge) {
          badge.textContent = data.count;
          badge.classList.remove('d-none');
        }
        // Анимация кнопки
        btn.innerHTML = '<i class="bi bi-check-lg"></i>';
        btn.classList.remove('btn-outline-warning');
        btn.classList.add('btn-warning');
        setTimeout(() => {
          btn.innerHTML = '<i class="bi bi-cart-plus"></i>';
          btn.classList.remove('btn-warning');
          btn.classList.add('btn-outline-warning');
        }, 1500);
      }
    });
  });
});

// Поиск/фильтрация каталога
function filterCars() {
  const search = (document.getElementById('searchInput')?.value || '').toLowerCase();
  const brand  = document.getElementById('brandFilter')?.value || '';
  const sort   = document.getElementById('sortFilter')?.value || '';
  let cards    = Array.from(document.querySelectorAll('.car-card'));

  cards.forEach(card => {
    const name = card.dataset.name || '';
    const b    = card.dataset.brand || '';
    const show = (!search || name.includes(search) || b.toLowerCase().includes(search))
              && (!brand  || b === brand);
    card.style.display = show ? '' : 'none';
  });

  if (sort) {
    const grid    = document.getElementById('carsGrid');
    const visible = cards.filter(c => c.style.display !== 'none');
    visible.sort((a, b) => {
      if (sort === 'price_asc')  return +a.dataset.price - +b.dataset.price;
      if (sort === 'price_desc') return +b.dataset.price - +a.dataset.price;
      if (sort === 'year_asc')   return +a.dataset.year  - +b.dataset.year;
      if (sort === 'year_desc')  return +b.dataset.year  - +a.dataset.year;
      return 0;
    });
    visible.forEach(c => grid.appendChild(c));
  }
  const visible = cards.filter(c => c.style.display !== 'none');
  const noResults = document.getElementById('noResults');
  if (noResults) noResults.classList.toggle('d-none', visible.length > 0);
  const counter = document.getElementById('resultCount');
  if (counter) counter.textContent = visible.length;
  const badge = document.getElementById('filterBadge');
  if (badge) {
    const hasFilters = (document.getElementById('searchInput')?.value || '') !== ''
                    || (document.getElementById('brandFilter')?.value || '') !== ''
                    || (document.getElementById('sortFilter')?.value || '') !== '';
    badge.classList.toggle('d-none', !hasFilters);
  }
}
</script>
</body>
</html>
