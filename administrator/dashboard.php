<?php
session_start();
if (!isset($_SESSION['joomla_admin'])) {
    header('Location: index.php');
    exit;
}
if (isset($_GET['logout'])) {
    unset($_SESSION['joomla_admin']);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Панель управления RetroAuto - Joomla! 5</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root {
      --sidebar-width: 260px;
      --bg-joomla-dark: #121824;
      --bg-joomla-blue: #182238;
      --border-joomla: #27354f;
    }
    body {
      background-color: #f3f4f6;
      font-family: system-ui, -apple-system, sans-serif;
      overflow-x: hidden;
    }
    /* SIDEBAR */
    .admin-sidebar {
      width: var(--sidebar-width);
      background-color: var(--bg-joomla-blue);
      color: #cbd5e1;
      height: 100vh;
      position: fixed;
      top: 0; left: 0;
      z-index: 1000;
      border-right: 1px solid var(--border-joomla);
      display: flex;
      flex-direction: column;
    }
    .sidebar-brand {
      background-color: var(--bg-joomla-dark);
      padding: 1.25rem;
      border-bottom: 1px solid var(--border-joomla);
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      color: #fff;
    }
    .sidebar-brand img { width: 32px; }
    .sidebar-menu {
      flex-grow: 1;
      padding: 1rem 0;
      overflow-y: auto;
    }
    .menu-header {
      font-size: 0.75rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: #64748b;
      padding: 0.5rem 1.5rem;
      font-weight: 700;
    }
    .menu-item {
      display: flex;
      align-items: center;
      padding: 0.65rem 1.5rem;
      color: #cbd5e1;
      text-decoration: none;
      font-size: 0.92rem;
      transition: all 0.2s;
      gap: 12px;
    }
    .menu-item:hover {
      background-color: rgba(255,255,255,0.05);
      color: #fff;
    }
    .menu-item.active {
      background-color: #0d6efd;
      color: #fff;
      font-weight: 600;
    }
    .menu-item i { font-size: 1.1rem; }

    /* CONTENT */
    .admin-content {
      margin-left: var(--sidebar-width);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    /* TOPBAR */
    .admin-topbar {
      background-color: #fff;
      border-bottom: 1px solid #e5e7eb;
      padding: 0.75rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky; top: 0; z-index: 990;
    }
    .page-title {
      font-size: 1.25rem;
      font-weight: 700;
      color: #1f2937;
      margin: 0;
    }
    .main-body {
      padding: 2rem;
      flex-grow: 1;
    }
    .card-dashboard {
      border: 0;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.05);
      background: #fff;
      margin-bottom: 1.5rem;
    }
    .card-header-joomla {
      background-color: #fff;
      border-bottom: 1px solid #f3f4f6;
      font-weight: 700;
      color: #1f2937;
      padding: 1rem 1.25rem;
    }
    /* TABLES */
    .table-joomla th {
      background-color: #f9fafb !important;
      color: #4b5563;
      font-weight: 600;
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }
    .table-joomla td {
      font-size: 0.9rem;
      color: #374151;
      vertical-align: middle;
    }
    .star-active { color: #ffb703; font-size: 1.2rem; }
    .star-inactive { color: #d1d5db; font-size: 1.2rem; }
  </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="admin-sidebar">
  <a href="#" class="sidebar-brand">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5a/Joomla_logo.svg/2560px-Joomla_logo.svg.png" alt="Joomla">
    <span class="fw-bold">Joomla! 5.0</span>
  </a>
  <div class="sidebar-menu">
    <div class="menu-header">Навигация</div>
    <a href="#" class="menu-item active" onclick="switchTab('dashboard', this)">
      <i class="bi bi-speedometer2"></i> Панель управления
    </a>
    
    <div class="menu-header">Контент & Оформление</div>
    <a href="#" class="menu-item" onclick="switchTab('articles', this)">
      <i class="bi bi-file-text"></i> Материалы (Статьи)
    </a>
    <a href="#" class="menu-item" onclick="switchTab('menus', this)">
      <i class="bi bi-list"></i> Пункты меню
    </a>
    <a href="#" class="menu-item" onclick="switchTab('templates', this)">
      <i class="bi bi-brush"></i> Стили шаблонов
    </a>

    <div class="menu-header">Магазин VirtueMart</div>
    <a href="#" class="menu-item" onclick="switchTab('vm_categories', this)">
      <i class="bi bi-folder2-open"></i> Категории товаров
    </a>
    <a href="#" class="menu-item" onclick="switchTab('vm_products', this)">
      <i class="bi bi-cart3"></i> Список товаров
    </a>
    <a href="#" class="menu-item" onclick="switchTab('vm_edit', this)">
      <i class="bi bi-pencil-square"></i> Редактирование товара
    </a>
  </div>
  
  <div class="p-3 border-top border-secondary text-center">
    <div class="small text-muted mb-2">Администратор</div>
    <a href="?logout=1" class="btn btn-outline-danger btn-sm w-100"><i class="bi bi-box-arrow-left me-1"></i> Выйти</a>
  </div>
</div>

<!-- MAIN CONTENT -->
<div class="admin-content">
  
  <!-- TOPBAR -->
  <div class="admin-topbar">
    <h1 class="page-title" id="pageTitle">Панель управления RetroAuto</h1>
    <div class="d-flex align-items-center gap-3">
      <span class="badge bg-success">Режим: Онлайн</span>
      <a href="../index.php" target="_blank" class="btn btn-outline-primary btn-sm"><i class="bi bi-eye me-1"></i> Просмотр сайта</a>
    </div>
  </div>

  <!-- MAIN BODY -->
  <div class="main-body">

    <!-- 1. DASHBOARD TAB -->
    <div id="tab-dashboard" class="tab-content-joomla">
      <div class="row">
        <div class="col-lg-8">
          <div class="card card-dashboard">
            <div class="card-header card-header-joomla">Популярные материалы сайта</div>
            <div class="card-body p-0">
              <table class="table table-hover table-joomla mb-0">
                <thead>
                  <tr>
                    <th>Заголовок</th>
                    <th>Дата создания</th>
                    <th>Просмотры</th>
                    <th>Состояние</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><a href="#" class="text-decoration-none fw-bold" onclick="switchTab('articles')">О себе (Гущин С.Д., группа ИС-О-24/1)</a></td>
                    <td>20.10.2023</td>
                    <td>415</td>
                    <td><span class="badge bg-success">Опубликовано</span></td>
                  </tr>
                  <tr>
                    <td><a href="#" class="text-decoration-none fw-bold" onclick="switchTab('articles')">Лабораторные работы</a></td>
                    <td>18.10.2023</td>
                    <td>320</td>
                    <td><span class="badge bg-success">Опубликовано</span></td>
                  </tr>
                  <tr>
                    <td><a href="#" class="text-decoration-none fw-bold" onclick="switchTab('articles')">История авто</a></td>
                    <td>18.10.2023</td>
                    <td>155</td>
                    <td><span class="badge bg-success">Опубликовано</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          
          <div class="card card-dashboard">
            <div class="card-header card-header-joomla">Быстрые действия</div>
            <div class="card-body">
              <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-primary" onclick="switchTab('articles')"><i class="bi bi-plus-circle me-1"></i> Создать материал</button>
                <button class="btn btn-success" onclick="switchTab('menus')"><i class="bi bi-list me-1"></i> Настроить меню</button>
                <button class="btn btn-info text-white" onclick="switchTab('templates')"><i class="bi bi-brush me-1"></i> Стили оформления</button>
                <button class="btn btn-warning text-white" onclick="switchTab('vm_products')"><i class="bi bi-cart-plus me-1"></i> Добавить товар в VirtueMart</button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card card-dashboard">
            <div class="card-header card-header-joomla">Статус системы</div>
            <div class="card-body">
              <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                  <span class="text-muted">Версия Joomla</span>
                  <strong>Joomla! 5.0.0</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                  <span class="text-muted">Версия PHP</span>
                  <strong>8.5.2</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                  <span class="text-muted">СУБД</span>
                  <strong>MySQLi 8.0</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                  <span class="text-muted">Веб-сервер</span>
                  <strong>Apache/PHP-CLI</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                  <span class="text-muted">Кэширование</span>
                  <strong class="text-success">Включено</strong>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 2. ARTICLES TAB -->
    <div id="tab-articles" class="tab-content-joomla d-none">
      <div class="card card-dashboard">
        <div class="card-header card-header-joomla d-flex justify-content-between align-items-center">
          <span>Список статей (Контент - Материалы)</span>
          <button class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Создать</button>
        </div>
        <div class="card-body p-0">
          <table class="table table-hover table-joomla mb-0">
            <thead>
              <tr>
                <th style="width: 40px;"><input type="checkbox"></th>
                <th>Заголовок</th>
                <th>Состояние</th>
                <th>Категория</th>
                <th>Доступ</th>
                <th>Язык</th>
                <th>ID</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="checkbox"></td>
                <td><a href="#" class="text-decoration-none fw-bold">О себе (Гущин С.Д., группа ИС-О-24/1)</a></td>
                <td><span class="text-success"><i class="bi bi-check-circle-fill"></i> Опубликовано</span></td>
                <td>Uncategorised</td>
                <td>Public</td>
                <td>Все</td>
                <td>3</td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td><a href="#" class="text-decoration-none fw-bold">Лабораторные работы</a></td>
                <td><span class="text-success"><i class="bi bi-check-circle-fill"></i> Опубликовано</span></td>
                <td>Uncategorised</td>
                <td>Public</td>
                <td>Все</td>
                <td>2</td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td><a href="#" class="text-decoration-none fw-bold">Обратная связь</a></td>
                <td><span class="text-success"><i class="bi bi-check-circle-fill"></i> Опубликовано</span></td>
                <td>Uncategorised</td>
                <td>Public</td>
                <td>Все</td>
                <td>1</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- 3. MENUS TAB -->
    <div id="tab-menus" class="tab-content-joomla d-none">
      <div class="card card-dashboard">
        <div class="card-header card-header-joomla">Пункты меню: Главное меню</div>
        <div class="card-body p-0">
          <table class="table table-hover table-joomla mb-0">
            <thead>
              <tr>
                <th style="width: 40px;"><input type="checkbox"></th>
                <th>Название</th>
                <th>Состояние</th>
                <th>Порядок</th>
                <th>Доступ</th>
                <th>Язык</th>
                <th>ID</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="checkbox"></td>
                <td class="fw-bold"><i class="bi bi-house-door me-2"></i>Главная</td>
                <td><span class="text-success"><i class="bi bi-check-circle-fill"></i> Опубликовано</span></td>
                <td>1</td>
                <td>Public</td>
                <td>Все</td>
                <td>101</td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td class="fw-bold"><i class="bi bi-person me-2"></i>О себе</td>
                <td><span class="text-success"><i class="bi bi-check-circle-fill"></i> Опубликовано</span></td>
                <td>2</td>
                <td>Public</td>
                <td>Все</td>
                <td>102</td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td class="fw-bold"><i class="bi bi-folder-check me-2"></i>Лабораторные</td>
                <td><span class="text-success"><i class="bi bi-check-circle-fill"></i> Опубликовано</span></td>
                <td>3</td>
                <td>Public</td>
                <td>Все</td>
                <td>103</td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td class="fw-bold"><i class="bi bi-envelope me-2"></i>Обратная связь</td>
                <td><span class="text-success"><i class="bi bi-check-circle-fill"></i> Опубликовано</span></td>
                <td>4</td>
                <td>Public</td>
                <td>Все</td>
                <td>104</td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td class="fw-bold"><i class="bi bi-grid me-2"></i>Каталог</td>
                <td><span class="text-success"><i class="bi bi-check-circle-fill"></i> Опубликовано</span></td>
                <td>5</td>
                <td>Public</td>
                <td>Все</td>
                <td>105</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- 4. TEMPLATES TAB -->
    <div id="tab-templates" class="tab-content-joomla d-none">
      <div class="card card-dashboard">
        <div class="card-header card-header-joomla">Система - Шаблоны - Стили</div>
        <div class="card-body p-0">
          <table class="table table-hover table-joomla mb-0">
            <thead>
              <tr>
                <th style="width: 40px;"><input type="checkbox"></th>
                <th>Стили</th>
                <th>Шаблон</th>
                <th>Раздел</th>
                <th>По умолчанию</th>
                <th>ID</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="checkbox"></td>
                <td><a href="#" class="text-decoration-none fw-bold">Cassiopeia - Default</a></td>
                <td>Cassiopeia</td>
                <td>Сайт</td>
                <td><i class="bi bi-circle star-inactive"></i></td>
                <td>10</td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td><a href="#" class="text-decoration-none fw-bold text-warning">retroauto_theme - Default</a></td>
                <td class="fw-semibold">retroauto_theme</td>
                <td>Сайт</td>
                <td><i class="bi bi-star-fill star-active"></i></td>
                <td>15</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- 5. VM CATEGORIES TAB -->
    <div id="tab-vm_categories" class="tab-content-joomla d-none">
      <div class="card card-dashboard">
        <div class="card-header card-header-joomla">VirtueMart: Категории товаров</div>
        <div class="card-body p-0">
          <table class="table table-hover table-joomla mb-0">
            <thead>
              <tr>
                <th style="width: 40px;"><input type="checkbox"></th>
                <th>Название категории</th>
                <th>Опубликовано</th>
                <th>Порядок</th>
                <th>ID</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="checkbox"></td>
                <td class="fw-bold">Классические автомобили</td>
                <td><span class="text-success"><i class="bi bi-check-circle-fill"></i> Да</span></td>
                <td>1</td>
                <td>21</td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td class="fw-bold">Кабриолеты</td>
                <td><span class="text-success"><i class="bi bi-check-circle-fill"></i> Да</span></td>
                <td>2</td>
                <td>22</td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td class="fw-bold">Маслкары</td>
                <td><span class="text-success"><i class="bi bi-check-circle-fill"></i> Да</span></td>
                <td>3</td>
                <td>23</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- 6. VM PRODUCTS TAB -->
    <div id="tab-vm_products" class="tab-content-joomla d-none">
      <div class="card card-dashboard">
        <div class="card-header card-header-joomla d-flex justify-content-between align-items-center">
          <span>VirtueMart: Список товаров</span>
          <button class="btn btn-warning text-white btn-sm" onclick="switchTab('vm_edit')"><i class="bi bi-plus-lg"></i> Добавить</button>
        </div>
        <div class="card-body p-0">
          <table class="table table-hover table-joomla mb-0">
            <thead>
              <tr>
                <th style="width: 40px;"><input type="checkbox"></th>
                <th>Изображение</th>
                <th>Наименование товара</th>
                <th>Артикул</th>
                <th>Категория</th>
                <th>Цена</th>
                <th>Опубликовано</th>
                <th>ID</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="checkbox"></td>
                <td><img src="https://images.unsplash.com/photo-1620861943958-fc98832e1713?w=100&h=60&fit=crop" style="border-radius:4px;" alt="Bel Air"></td>
                <td><a href="#" class="text-decoration-none fw-bold" onclick="switchTab('vm_edit')">Chevrolet Bel Air</a></td>
                <td>CH-1957</td>
                <td>Классические автомобили</td>
                <td class="fw-bold text-success">45 000,00 &euro;</td>
                <td><span class="text-success"><i class="bi bi-check-circle-fill"></i> Да</span></td>
                <td>101</td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td><img src="https://images.unsplash.com/photo-1576425955345-f48eae74fc44?w=100&h=60&fit=crop" style="border-radius:4px;" alt="Mercedes"></td>
                <td><a href="#" class="text-decoration-none fw-bold">Mercedes-Benz 190SL</a></td>
                <td>MB-1960</td>
                <td>Классические автомобили</td>
                <td class="fw-bold text-success">95 000,00 &euro;</td>
                <td><span class="text-success"><i class="bi bi-check-circle-fill"></i> Да</span></td>
                <td>102</td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td><img src="https://images.unsplash.com/photo-1650634179095-cac904c35b63?w=100&h=60&fit=crop" style="border-radius:4px;" alt="Mustang"></td>
                <td><a href="#" class="text-decoration-none fw-bold">Ford Mustang Fastback</a></td>
                <td>FM-1965</td>
                <td>Классические автомобили</td>
                <td class="fw-bold text-success">72 500,00 &euro;</td>
                <td><span class="text-success"><i class="bi bi-check-circle-fill"></i> Да</span></td>
                <td>103</td>
              </tr>
              <tr>
                <td><input type="checkbox"></td>
                <td><img src="https://images.unsplash.com/photo-1581163980256-d9581d08d401?w=100&h=60&fit=crop" style="border-radius:4px;" alt="Eldorado"></td>
                <td><a href="#" class="text-decoration-none fw-bold">Cadillac Eldorado</a></td>
                <td>CE-1959</td>
                <td>Классические автомобили</td>
                <td class="fw-bold text-success">110 000,00 &euro;</td>
                <td><span class="text-success"><i class="bi bi-check-circle-fill"></i> Да</span></td>
                <td>104</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- 7. VM PRODUCT EDIT TAB -->
    <div id="tab-vm_edit" class="tab-content-joomla d-none">
      <div class="card card-dashboard">
        <div class="card-header card-header-joomla bg-light d-flex justify-content-between align-items-center">
          <span>Редактирование товара: Chevrolet Bel Air</span>
          <div class="d-flex gap-2">
            <button class="btn btn-success btn-sm" onclick="switchTab('vm_products')"><i class="bi bi-check-lg"></i> Сохранить</button>
            <button class="btn btn-outline-secondary btn-sm" onclick="switchTab('vm_products')">Закрыть</button>
          </div>
        </div>
        <div class="card-body">
          <!-- VM tabs mockup -->
          <ul class="nav nav-tabs mb-4" id="vmEditTabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" href="#">Информация о товаре</a></li>
            <li class="nav-item"><a class="nav-link text-secondary" href="#">Описание товара</a></li>
            <li class="nav-item"><a class="nav-link text-secondary" href="#">Статус товара</a></li>
            <li class="nav-item"><a class="nav-link text-secondary" href="#">Габариты и вес</a></li>
            <li class="nav-item"><a class="nav-link text-secondary" href="#">Изображения товара</a></li>
          </ul>
          
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-bold small">Наименование товара *</label>
              <input type="text" class="form-control" value="Chevrolet Bel Air">
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold small">Артикул (SKU)</label>
              <input type="text" class="form-control" value="CH-1957">
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold small">Категория товара</label>
              <select class="form-select">
                <option selected>Классические автомобили</option>
                <option>Кабриолеты</option>
                <option>Маслкары</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold small">Базовая цена</label>
              <div class="input-group">
                <input type="text" class="form-control" value="45 000,00">
                <span class="input-group-text">&euro;</span>
              </div>
            </div>
            <div class="col-md-12">
              <label class="form-label fw-bold small">Краткое описание</label>
              <textarea class="form-control" rows="3">Легендарный американский автомобиль эпохи 50-х с характерными плавниками и хромированными деталями.</textarea>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

<script>
  function switchTab(tabId, el) {
    // Hide all contents
    const contents = document.querySelectorAll('.tab-content-joomla');
    contents.forEach(c => c.classList.add('d-none'));
    
    // Show target content
    const target = document.getElementById('tab-' + tabId);
    if (target) target.classList.remove('d-none');
    
    // Update active class in sidebar if element is passed
    if (el) {
      const items = document.querySelectorAll('.menu-item');
      items.forEach(i => i.classList.remove('active'));
      el.classList.add('active');
    } else {
      // Find element manually
      const items = document.querySelectorAll('.menu-item');
      items.forEach(i => {
        if (i.getAttribute('onclick').includes(tabId)) {
          items.forEach(x => x.classList.remove('active'));
          i.classList.add('active');
        }
      });
    }

    // Set page title
    const titles = {
      'dashboard': 'Панель управления RetroAuto',
      'articles': 'Материалы (Статьи)',
      'menus': 'Пункты меню: Главное меню',
      'templates': 'Система - Шаблоны - Стили',
      'vm_categories': 'VirtueMart: Категории товаров',
      'vm_products': 'VirtueMart: Список товаров',
      'vm_edit': 'Редактирование товара: Chevrolet Bel Air'
    };
    document.getElementById('pageTitle').innerText = titles[tabId] || 'Панель управления';
  }
</script>

</body>
</html>
