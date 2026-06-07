<?php
require_once 'partials/db.php';
require_once 'partials/header.php';

$labs = [
  [
    'id' => 1,
    'title' => 'Лабораторная работа №1',
    'description' => 'Разработка статической структуры веб-страниц и базовая верстка макетов по макету Figma.',
    'tech' => ['HTML5', 'CSS3', 'Семантический код'],
    'status' => 'Сдана',
    'badgeBg' => 'bg-success'
  ],
  [
    'id' => 2,
    'title' => 'Лабораторная работа №2',
    'description' => 'Создание адаптивного дизайна и интерактивных компонентов с использованием Bootstrap и медиа-запросов.',
    'tech' => ['CSS Flexbox/Grid', 'Bootstrap 5', 'Адаптивность'],
    'status' => 'Сдана',
    'badgeBg' => 'bg-success'
  ],
  [
    'id' => 3,
    'title' => 'Лабораторная работа №3',
    'description' => 'Интеграция клиентской логики на JavaScript: управление корзиной товаров, анимация счетчиков и фильтрация каталога.',
    'tech' => ['JavaScript (ES6)', 'localStorage', 'jQuery'],
    'status' => 'Сдана',
    'badgeBg' => 'bg-success'
  ],
  [
    'id' => 4,
    'title' => 'Лабораторная работа №4',
    'description' => 'Разработка серверной части интернет-магазина: создание БД MySQL, вывод каталога из базы данных через PHP PDO.',
    'tech' => ['PHP 8.x', 'MySQL', 'PDO Connection'],
    'status' => 'Сдана',
    'badgeBg' => 'bg-success'
  ],
  [
    'id' => 5,
    'title' => 'Лабораторная работа №5',
    'description' => 'Создание системы оформления заказов, отправки AJAX-запросов на сервер и динамического обновления списков.',
    'tech' => ['AJAX / JSON', 'PHP Sessions', 'jQuery.ajax'],
    'status' => 'Сдана',
    'badgeBg' => 'bg-success'
  ],
  [
    'id' => 6,
    'title' => 'Лабораторная работа №6 (Текущая)',
    'description' => 'Установка и настройка CMS Joomla, выбор темы оформления, интеграция модуля Virtuemart и создание отчетного документа.',
    'tech' => ['Joomla CMS', 'Virtuemart', 'Word (docx) report'],
    'status' => 'В процессе проверки',
    'badgeBg' => 'bg-warning text-dark'
  ]
];
?>

<div class="py-5 bg-light min-vh-100">
  <div class="container">
    <div class="mx-auto" style="max-width: 900px;">
      
      <div class="text-center mb-5">
        <span class="badge bg-warning text-dark mb-2 px-3 py-2">Список работ</span>
        <h1 class="display-4 fw-bold mb-3">Лабораторные работы</h1>
        <p class="fs-5 text-muted">Выполненные задания по курсу веб-разработки (студент Гущин С.Д.)</p>
      </div>

      <div class="card border-0 shadow-sm p-4" style="border-radius: 16px;">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th style="width: 80px;">№</th>
                <th>Название темы</th>
                <th>Описание</th>
                <th>Стек технологий</th>
                <th style="width: 160px;">Статус</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($labs as $lab): ?>
                <tr>
                  <td class="fw-bold text-muted"><?= $lab['id'] ?></td>
                  <td class="fw-bold text-dark"><?= htmlspecialchars($lab['title']) ?></td>
                  <td class="small text-muted" style="max-width: 250px;"><?= htmlspecialchars($lab['description']) ?></td>
                  <td>
                    <div class="d-flex flex-wrap gap-1">
                      <?php foreach ($lab['tech'] as $t): ?>
                        <span class="badge bg-light text-secondary border small">
                          <?= htmlspecialchars($t) ?>
                        </span>
                      <?php endforeach; ?>
                    </div>
                  </td>
                  <td>
                    <span class="badge <?= $lab['badgeBg'] ?> px-3 py-2 w-100 text-center">
                      <?= htmlspecialchars($lab['status']) ?>
                    </span>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="mt-4 text-center">
        <a href="student.php" class="btn btn-warning px-4 py-2">
          <i class="bi bi-arrow-left me-2"></i>Вернуться к профилю
        </a>
      </div>

    </div>
  </div>
</div>

<?php
require_once 'partials/footer.php';
?>
