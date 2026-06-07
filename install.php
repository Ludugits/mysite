<?php
// Подключение к MySQL (без выбора БД)
$host    = 'localhost';
$user    = 'root';
$pass    = '';
$dbname  = 'retroauto';
$charset = 'utf8mb4';

try {
    $pdo = new PDO("mysql:host=$host;charset=$charset", $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // 1. Создаём базу данных
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `$dbname`");

    // 2. Удаляем старые таблицы и создаём заново
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    $pdo->exec("DROP TABLE IF EXISTS feedback_items");
    $pdo->exec("DROP TABLE IF EXISTS feedback");
    $pdo->exec("DROP TABLE IF EXISTS items");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

    // 3. Таблица автомобилей
    $pdo->exec("CREATE TABLE items (
        id            INT AUTO_INCREMENT PRIMARY KEY,
        name          VARCHAR(120) NOT NULL,
        year          SMALLINT NOT NULL,
        manufacturer  VARCHAR(80) NOT NULL,
        description   TEXT,
        price         VARCHAR(30) NOT NULL,
        image         TEXT,
        features      TEXT,
        engine        VARCHAR(80),
        power         VARCHAR(40),
        transmission  VARCHAR(80),
        color         VARCHAR(60),
        created_at    DATETIME DEFAULT NOW()
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    // 4. Таблица заявок
    $pdo->exec("CREATE TABLE feedback (
        id          INT AUTO_INCREMENT PRIMARY KEY,
        name        VARCHAR(120) NOT NULL,
        email       VARCHAR(180) NOT NULL,
        phone       VARCHAR(40) NOT NULL,
        message     TEXT,
        newsletter  TINYINT(1) DEFAULT 0,
        created_at  DATETIME DEFAULT NOW()
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    // 5. Связь заявок с авто
    $pdo->exec("CREATE TABLE feedback_items (
        id          INT AUTO_INCREMENT PRIMARY KEY,
        feedback_id INT NOT NULL,
        item_id     INT NOT NULL,
        FOREIGN KEY (feedback_id) REFERENCES feedback(id) ON DELETE CASCADE,
        FOREIGN KEY (item_id)     REFERENCES items(id)    ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    // 6. Заполняем автомобилями
    $stmt = $pdo->prepare("INSERT INTO items (name, year, manufacturer, description, price, image, features, engine, power, transmission, color) VALUES (?,?,?,?,?,?,?,?,?,?,?)");

    $cars = [
        ['Chevrolet Bel Air',     1957, 'Chevrolet',    'Легендарный американский автомобиль эпохи 50-х с характерными плавниками и хромированными деталями. Символ американской мечты и золотого века автопрома.', '45 000 €', 'https://images.unsplash.com/photo-1620861943958-fc98832e1713?w=800', json_encode(['Оригинальная краска','Хромированные бамперы','V8 двигатель','Кожаный салон']),        'V8 4.6L',             '220 л.с.', 'Автоматическая',    'Голубой'],
        ['Mercedes-Benz 190SL',   1960, 'Mercedes-Benz','Элегантный немецкий родстер с утончённым дизайном и непревзойдённым качеством сборки. Идеальное сочетание стиля и инженерного совершенства.',             '95 000 €', 'https://images.unsplash.com/photo-1576425955345-f48eae74fc44?w=800', json_encode(['Откидной верх','Оригинальные диски','Редкая модель','Полная реставрация']),           'Рядный-4 1.9L',       '105 л.с.', 'Механическая 4-ст', 'Белый'],
        ['Ford Mustang Fastback',  1968, 'Ford',         'Культовый американский маслкар. Агрессивный кузов Fastback и ревущий V8 делают его желанным для коллекционеров.',                                          '65 000 €', 'https://images.unsplash.com/photo-1650634179095-cac904c35b63?w=800', json_encode(['Fastback кузов','Спортивная подвеска','Оригинальный интерьер','Документы в порядке']),   'V8 5.0L',             '271 л.с.', 'Механическая 4-ст', 'Чёрный'],
        ['Cadillac Eldorado',      1959, 'Cadillac',     'Воплощение американской роскоши и экстравагантности 50-х годов. Огромные плавники и обилие хрома.',                                                        '78 000 €', 'https://images.unsplash.com/photo-1581163980256-d9581d08d401?w=800', json_encode(['Электрические стеклоподъёмники','Кондиционер','Кожаный салон','Хромированные детали']),  'V8 6.4L',             '345 л.с.', 'Автоматическая',    'Чёрный'],
        ['Jaguar E-Type',          1963, 'Jaguar',       'Признан одним из красивейших автомобилей всех времён. Стремительные линии кузова и мощный двигатель.',                                                     '120 000 €','https://images.unsplash.com/photo-1743044771480-773e60701321?w=800', json_encode(['Кузов купе','Независимая подвеска','Дисковые тормоза','Оригинальный цвет']),            'Рядный-6 3.8L',       '265 л.с.', 'Механическая 4-ст', 'Зелёный'],
        ['Porsche 356 B',          1961, 'Porsche',      'Первый серийный автомобиль Porsche. Лёгкий, манёвренный и харизматичный — эталон спортивного вождения.',                                                   '110 000 €','https://images.unsplash.com/photo-1595521534390-0da06e43ae71?w=800', json_encode(['Алюминиевый кузов','Заднемоторная компоновка','Спортивный руль','Полная документация']),  'Оппозитный-4 1.6L',   '90 л.с.',  'Механическая 4-ст', 'Синий'],
        ['Dodge Charger',          1969, 'Dodge',        'Икона американского маслкар-движения с агрессивным дизайном и рёвом мощного V8 Hemi.',                                                                      '72 000 €', 'https://images.unsplash.com/photo-1676919508861-55c8c793b8ff?w=800', json_encode(['V8 Hemi двигатель','Широкий кузов','Хромированные диски','Мощные тормоза']),            'V8 7.2L Hemi',        '375 л.с.', 'Механическая 4-ст', 'Чёрный'],
        ['Volkswagen Beetle',      1965, 'Volkswagen',   'Один из самых узнаваемых автомобилей в истории. Простота, надёжность и очарование.',                                                                       '22 000 €', 'https://images.unsplash.com/photo-1513178532803-0d3db9cf7696?w=800', json_encode(['Заднемоторная компоновка','Оригинальный салон','Экономичный','Простое обслуживание']),   'Оппозитный-4 1.2L',   '40 л.с.',  'Механическая 4-ст', 'Бирюзовый'],
        ['Chevrolet Corvette C1',  1958, 'Chevrolet',    'Первое поколение легендарного американского спорткара с изящными формами и впечатляющей динамикой.',                                                       '85 000 €', 'https://images.unsplash.com/photo-1556025422-158fcdd0bcc3?w=800', json_encode(['Хромированные детали','Двухцветный кузов','Спортивные сиденья','Редкая комплектация']),   'V8 4.6L',             '230 л.с.', 'Механическая 3-ст', 'Красный'],
    ];

    foreach ($cars as $c) {
        $stmt->execute($c);
    }

    $count = count($cars);

    echo '<!DOCTYPE html><html lang="ru"><head><meta charset="UTF-8">
    <title>Установка RetroAuto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head><body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow border-0 p-5 text-center" style="max-width:500px;">
      <div class="mb-4" style="font-size:4rem;">✅</div>
      <h2 class="fw-bold mb-3">База данных готова!</h2>
      <p class="text-muted mb-1">✓ База данных <strong>retroauto</strong> создана</p>
      <p class="text-muted mb-1">✓ Таблица <strong>items</strong> — ' . $count . ' автомобилей</p>
      <p class="text-muted mb-4">✓ Таблица <strong>feedback</strong> — заполняется при заказах</p>
      <a href="index.php" class="btn btn-warning btn-lg px-5">Перейти на сайт →</a>
    </div>
    </body></html>';

} catch (PDOException $e) {
    echo '<!DOCTYPE html><html lang="ru"><head><meta charset="UTF-8">
    <title>Ошибка</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head><body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow border-0 p-5 text-center" style="max-width:500px;">
      <div class="mb-4" style="font-size:4rem;">❌</div>
      <h2 class="fw-bold mb-3">Ошибка подключения</h2>
      <p class="text-danger">' . htmlspecialchars($e->getMessage()) . '</p>
      <p class="text-muted">Убедитесь что MySQL запущен в OpenServer</p>
    </div>
    </body></html>';
}
