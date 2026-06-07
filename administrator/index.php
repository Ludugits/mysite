<?php
session_start();
if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    if ($username === 'Administrator' || $username === 'admin') {
        $_SESSION['joomla_admin'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Неверное имя пользователя или пароль';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Авторизация | Панель администратора Joomla</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #0d1b2a, #1b263b);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: system-ui, -apple-system, sans-serif;
    }
    .login-card {
      background: #ffffff;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
      width: 100%;
      max-width: 420px;
      padding: 2.5rem;
      border: 1px solid rgba(255,255,255,0.1);
    }
    .joomla-logo {
      width: 180px;
      margin-bottom: 2rem;
    }
    .btn-joomla {
      background-color: #0b5ed7;
      border-color: #0b5ed7;
      color: #fff;
      font-weight: 600;
      padding: 0.75rem;
      transition: all 0.2s;
    }
    .btn-joomla:hover {
      background-color: #023e8a;
      border-color: #023e8a;
      color: #fff;
    }
    .form-control:focus {
      border-color: #0b5ed7;
      box-shadow: 0 0 0 0.25rem rgba(11, 94, 215, 0.25);
    }
  </style>
</head>
<body>

<div class="login-card text-center">
  <!-- Логотип Joomla -->
  <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5a/Joomla_logo.svg/2560px-Joomla_logo.svg.png" alt="Joomla! Logo" class="joomla-logo img-fluid">
  
  <h4 class="mb-4 text-dark fw-bold">Панель управления RetroAuto</h4>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger py-2 small" role="alert">
      <?= htmlspecialchars($error) ?>
    </div>
  <?php endif; ?>

  <form action="index.php" method="POST">
    <div class="mb-3 text-start">
      <label class="form-label small fw-semibold text-muted">Имя пользователя</label>
      <div class="input-group">
        <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-secondary"></i></span>
        <input type="text" name="username" class="form-control border-start-0" placeholder="Логин (например, Administrator)" required autofocus>
      </div>
    </div>

    <div class="mb-4 text-start">
      <label class="form-label small fw-semibold text-muted">Пароль</label>
      <div class="input-group">
        <span class="input-group-text bg-light border-end-0"><i class="bi bi-key text-secondary"></i></span>
        <input type="password" name="password" class="form-control border-start-0" placeholder="Пароль" required>
      </div>
    </div>

    <button type="submit" name="login" class="btn btn-joomla w-100 mb-3 shadow-sm">
      Войти <i class="bi bi-box-arrow-in-right ms-1"></i>
    </button>
  </form>

  <div class="text-muted small mt-4">
    Версия Joomla! 5.0.0 &copy; 2026
  </div>
</div>

</body>
</html>
