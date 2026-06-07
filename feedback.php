<?php
require_once 'partials/db.php';
require_once 'partials/header.php';

$success = false;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error = 'Пожалуйста, заполните все обязательные поля.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Некорректный формат email.';
    } else {
        // Записываем «отправленное» письмо в лог-файл (эмуляция отправки почты)
        $logPath = __DIR__ . '/feedback_emails.log';
        $logContent = "=== NEW EMAIL SEND SIMULATION ===\n" .
                      "Date: " . date('Y-m-d H:i:s') . "\n" .
                      "To: info@retroauto.ru\n" .
                      "From: $name <$email>\n" .
                      "Subject: $subject\n" .
                      "Message:\n$message\n" .
                      "=================================\n\n";
        
        file_put_contents($logPath, $logContent, FILE_APPEND);
        
        $success = true;
    }
}
?>

<div class="py-5 bg-light min-vh-100">
  <div class="container">
    <div class="mx-auto" style="max-width: 700px;">
      
      <div class="text-center mb-5">
        <span class="badge bg-warning text-dark mb-2 px-3 py-2">Связь с администратором</span>
        <h1 class="display-4 fw-bold mb-3">Обратная связь</h1>
        <p class="fs-5 text-muted">Отправьте сообщение администратору сайта RetroAuto (Administrator)</p>
      </div>

      <?php if ($success): ?>
        <div class="alert alert-success border-0 shadow-sm mb-4 d-flex align-items-center gap-3" role="alert">
          <div class="fs-3">✅</div>
          <div>
            <strong class="d-block">Сообщение отправлено на почту администратора!</strong>
            <span class="small text-muted">Мы свяжемся с вами в ближайшее время. Письмо успешно записано в лог-файл отправки.</span>
          </div>
        </div>
      <?php endif; ?>

      <?php if ($error): ?>
        <div class="alert alert-danger border-0 shadow-sm mb-4 d-flex align-items-center gap-3" role="alert">
          <div class="fs-3">❌</div>
          <div>
            <strong class="d-block">Ошибка отправки!</strong>
            <span class="small text-muted"><?= htmlspecialchars($error) ?></span>
          </div>
        </div>
      <?php endif; ?>

      <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 16px;">
        <form action="feedback.php" method="POST">
          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label fw-bold small text-muted">Ваше имя *</label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-warning"></i></span>
                <input 
                  type="text" 
                  name="name" 
                  class="form-control bg-light border-start-0" 
                  placeholder="Иван Иванов"
                  value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                  required 
                />
              </div>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-bold small text-muted">Email для связи *</label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-warning"></i></span>
                <input 
                  type="email" 
                  name="email" 
                  class="form-control bg-light border-start-0" 
                  placeholder="ivan@example.com"
                  value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                  required 
                />
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold small text-muted">Тема сообщения *</label>
            <input 
              type="text" 
              name="subject" 
              class="form-control bg-light" 
              placeholder="Вопрос по заказу / Предложение"
              value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>"
              required 
            />
          </div>

          <div class="mb-4">
            <label class="form-label fw-bold small text-muted">Текст сообщения *</label>
            <textarea 
              name="message" 
              class="form-control bg-light" 
              rows="5" 
              placeholder="Введите ваше сообщение здесь..."
              required
            ><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
          </div>

          <button 
            type="submit" 
            class="btn btn-warning w-100 py-3 fw-bold"
          >
            <i class="bi bi-send me-2"></i>Отправить письмо
          </button>
        </form>
      </div>

      <!-- Блок «Поделиться» -->
      <div class="card border-0 shadow-sm p-4 text-center" style="border-radius: 16px;">
        <h5 class="fw-bold mb-3">Поделиться сайтом в соцсетях:</h5>
        <div class="d-flex justify-content-center">
          <div 
            class="ya-share2" 
            data-curator="true" 
            data-services="messenger,vkontakte,odnoklassniki,telegram,twitter,viber,whatsapp"
          ></div>
        </div>
      </div>

    </div>
  </div>
</div>

<script src="https://yastatic.net/share2/share.js" async></script>

<?php
require_once 'partials/footer.php';
?>
