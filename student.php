<?php
require_once 'partials/db.php';
require_once 'partials/header.php';
?>

<div class="py-5 bg-light min-vh-100">
  <div class="container">
    <div class="mx-auto" style="max-width: 800px;">
      
      <div class="text-center mb-5">
        <span class="badge bg-warning text-dark mb-2 px-3 py-2">Студент-разработчик</span>
        <h1 class="display-4 fw-bold mb-3">Информация о себе</h1>
        <p class="fs-5 text-muted">Раздел выполнен в рамках выполнения Лабораторной работы №6</p>
      </div>

      <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 20px;">
        <div class="row g-0">
          
          <!-- Левая колонка с фото -->
          <div class="col-md-5 bg-dark d-flex align-items-center justify-content-center p-4 text-center">
            <div>
              <img 
                src="student_avatar.png" 
                alt="Гущин С.Д." 
                class="img-fluid rounded-circle border border-4 border-warning shadow-lg mb-3"
                style="width: 200px; height: 200px; object-fit: cover;"
              />
              <h3 class="text-white fw-bold mb-1">Гущин С.Д.</h3>
              <span class="badge bg-warning text-dark px-3 py-2">Группа ИС-О-24/1</span>
            </div>
          </div>

          <!-- Правая колонка с информацией -->
          <div class="col-md-7 bg-white p-5 d-flex flex-column justify-content-between">
            <div>
              <h4 class="fw-bold text-dark mb-4 pb-2 border-bottom border-warning border-2 d-inline-block">
                Персональные данные
              </h4>
              
              <div class="mb-3">
                <span class="text-muted d-block small">ФИО студента</span>
                <strong class="fs-5 text-dark">Гущин С.Д.</strong>
              </div>

              <div class="mb-3">
                <span class="text-muted d-block small">Специальность</span>
                <strong class="text-dark">Информационные системы и технологии</strong>
              </div>

              <div class="mb-3">
                <span class="text-muted d-block small">Роль в проекте</span>
                <strong class="text-warning">Главный разработчик / Администратор CMS</strong>
              </div>

              <div class="mb-4">
                <span class="text-muted d-block small">Краткое описание</span>
                <p class="text-muted mb-0 small" style="line-height: 1.6;">
                  В ходе выполнения лабораторных работ (1–6) я изучил стек веб-разработки (HTML5, CSS3, JavaScript, React, PHP) и развернул CMS Joomla для управления контентом, а также настроил интернет-магазин с помощью модуля Virtuemart для демонстрации классических автомобилей RetroAuto.
                </p>
              </div>
            </div>

            <div class="d-flex gap-2">
              <a href="labs.php" class="btn btn-warning flex-grow-1 py-2">
                <i class="bi bi-list-check me-2"></i>Лабораторные работы
              </a>
              <a href="feedback.php" class="btn btn-outline-warning py-2">
                <i class="bi bi-envelope me-2"></i>Связаться
              </a>
            </div>

          </div>

        </div>
      </div>

      <!-- Дополнительная карточка с навыками -->
      <div class="card border-0 shadow-sm mt-4 p-4" style="border-radius: 16px;">
        <h5 class="fw-bold mb-3">Технологический стек ЛР:</h5>
        <div class="d-flex gap-2 flex-wrap">
          <span class="badge bg-light text-dark border p-2">HTML5 / CSS3</span>
          <span class="badge bg-light text-dark border p-2">Vite / React</span>
          <span class="badge bg-light text-dark border p-2">Bootstrap 5</span>
          <span class="badge bg-light text-dark border p-2">PHP 8.x</span>
          <span class="badge bg-light text-dark border p-2">MySQL / PDO</span>
          <span class="badge bg-light text-dark border p-2">Joomla CMS</span>
          <span class="badge bg-light text-dark border p-2">Virtuemart E-commerce</span>
        </div>
      </div>

    </div>
  </div>
</div>

<?php
require_once 'partials/footer.php';
?>
