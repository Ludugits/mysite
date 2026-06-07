<?php
/**
 * script.php — CLI/утилиты для обслуживания базы данных RetroAuto
 *
 * Использование (из командной строки):
 *   php script.php install   — создать таблицы и заполнить тестовыми данными
 *   php script.php reset     — очистить таблицы (данные удаляются, структура остаётся)
 *   php script.php drop      — удалить все таблицы
 *   php script.php stats     — вывести статистику
 */

require_once __DIR__ . '/partials/db.php';

$command = $argv[1] ?? 'help';

switch ($command) {

    // ─────────────────────────────────────────────
    case 'install':
        install($pdo);
        break;

    case 'reset':
        reset_data($pdo);
        break;

    case 'drop':
        drop_tables($pdo);
        break;

    case 'stats':
        stats($pdo);
        break;

    default:
        echo "Использование: php script.php [install|reset|drop|stats]\n";
}

// ─── Функции ──────────────────────────────────────────────────────────────────

function install(PDO $pdo): void
{
    // Таблица автомобилей
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS cars (
            id            INT AUTO_INCREMENT PRIMARY KEY,
            name          VARCHAR(120)  NOT NULL,
            year          SMALLINT      NOT NULL,
            manufacturer  VARCHAR(80)   NOT NULL,
            description   TEXT,
            price         VARCHAR(30)   NOT NULL,
            image         TEXT,
            features      TEXT,          -- JSON-строка
            engine        VARCHAR(80),
            power         VARCHAR(40),
            transmission  VARCHAR(80),
            color         VARCHAR(60),
            created_at    DATETIME DEFAULT NOW()
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    // Таблица заявок
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS orders (
            id          INT AUTO_INCREMENT PRIMARY KEY,
            name        VARCHAR(120) NOT NULL,
            email       VARCHAR(180) NOT NULL,
            phone       VARCHAR(40)  NOT NULL,
            message     TEXT,
            newsletter  TINYINT(1) DEFAULT 0,
            created_at  DATETIME DEFAULT NOW()
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    // Связь заявок с автомобилями
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS feedback_items (
            id        INT AUTO_INCREMENT PRIMARY KEY,
            feedback_id  INT NOT NULL,
            car_id    INT NOT NULL,
            FOREIGN KEY (feedback_id) REFERENCES orders(id) ON DELETE CASCADE,
            FOREIGN KEY (car_id)   REFERENCES cars(id)   ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    echo "✓ Таблицы созданы.\n";

    // Проверяем, есть ли уже данные
    $count = $pdo->query("SELECT COUNT(*) FROM items")->fetchColumn();
    if ($count > 0) {
        echo "  Данные уже присутствуют ($count записей). Пропускаем вставку.\n";
        return;
    }

    seed_cars($pdo);
}

function seed_cars(PDO $pdo): void
{
    $cars = [
        [
            'name' => 'Chevrolet Bel Air', 'year' => 1957, 'manufacturer' => 'Chevrolet',
            'description' => 'Легендарный американский автомобиль эпохи 50-х с характерными плавниками и хромированными деталями. Символ американской мечты.',
            'price' => '45 000 €',
            'image' => 'https://images.unsplash.com/photo-1620861943958-fc98832e1713?w=800',
            'features' => json_encode(['Оригинальная краска', 'Хромированные бамперы', 'V8 двигатель', 'Кожаный салон']),
            'engine' => 'V8 4.6L', 'power' => '220 л.с.', 'transmission' => 'Автоматическая', 'color' => 'Голубой',
        ],
        [
            'name' => 'Mercedes-Benz 190SL', 'year' => 1960, 'manufacturer' => 'Mercedes-Benz',
            'description' => 'Элегантный немецкий родстер с утончённым дизайном и непревзойдённым качеством сборки.',
            'price' => '95 000 €',
            'image' => 'https://images.unsplash.com/photo-1576425955345-f48eae74fc44?w=800',
            'features' => json_encode(['Откидной верх', 'Оригинальные диски', 'Редкая модель', 'Полная реставрация']),
            'engine' => 'Рядный-4 1.9L', 'power' => '105 л.с.', 'transmission' => 'Механическая 4-ст', 'color' => 'Белый',
        ],
        [
            'name' => 'Ford Mustang Fastback', 'year' => 1968, 'manufacturer' => 'Ford',
            'description' => 'Культовый американский маслкар. Агрессивный кузов Fastback и ревущий V8 делают его желанным для коллекционеров.',
            'price' => '65 000 €',
            'image' => 'https://images.unsplash.com/photo-1650634179095-cac904c35b63?w=800',
            'features' => json_encode(['Fastback кузов', 'Спортивная подвеска', 'Оригинальный интерьер', 'Документы в порядке']),
            'engine' => 'V8 5.0L', 'power' => '271 л.с.', 'transmission' => 'Механическая 4-ст', 'color' => 'Чёрный',
        ],
        [
            'name' => 'Cadillac Eldorado', 'year' => 1959, 'manufacturer' => 'Cadillac',
            'description' => 'Воплощение американской роскоши и экстравагантности 50-х. Огромные плавники и обилие хрома.',
            'price' => '78 000 €',
            'image' => 'https://images.unsplash.com/photo-1581163980256-d9581d08d401?w=800',
            'features' => json_encode(['Электрические стеклоподъёмники', 'Кондиционер', 'Кожаный салон', 'Хромированные детали']),
            'engine' => 'V8 6.4L', 'power' => '345 л.с.', 'transmission' => 'Автоматическая', 'color' => 'Чёрный',
        ],
        [
            'name' => 'Jaguar E-Type', 'year' => 1963, 'manufacturer' => 'Jaguar',
            'description' => 'Признан одним из красивейших автомобилей всех времён. Стремительные линии и мощный двигатель.',
            'price' => '120 000 €',
            'image' => 'https://images.unsplash.com/photo-1743044771480-773e60701321?w=800',
            'features' => json_encode(['Кузов купе', 'Независимая подвеска', 'Дисковые тормоза', 'Оригинальный цвет']),
            'engine' => 'Рядный-6 3.8L', 'power' => '265 л.с.', 'transmission' => 'Механическая 4-ст', 'color' => 'Зелёный',
        ],
        [
            'name' => 'Porsche 356 B', 'year' => 1961, 'manufacturer' => 'Porsche',
            'description' => 'Первый серийный Porsche. Лёгкий, манёвренный и харизматичный — эталон спортивного вождения.',
            'price' => '110 000 €',
            'image' => 'https://images.unsplash.com/photo-1595521534390-0da06e43ae71?w=800',
            'features' => json_encode(['Алюминиевый кузов', 'Заднемоторная компоновка', 'Спортивный руль', 'Полная документация']),
            'engine' => 'Оппозитный-4 1.6L', 'power' => '90 л.с.', 'transmission' => 'Механическая 4-ст', 'color' => 'Синий',
        ],
        [
            'name' => 'Dodge Charger', 'year' => 1969, 'manufacturer' => 'Dodge',
            'description' => 'Икона американского маслкара с агрессивным дизайном и рёвом мощного V8 Hemi.',
            'price' => '72 000 €',
            'image' => 'https://images.unsplash.com/photo-1676919508861-55c8c793b8ff?w=800',
            'features' => json_encode(['V8 Hemi двигатель', 'Широкий кузов', 'Хромированные диски', 'Мощные тормоза']),
            'engine' => 'V8 7.2L Hemi', 'power' => '375 л.с.', 'transmission' => 'Механическая 4-ст', 'color' => 'Чёрный',
        ],
        [
            'name' => 'Volkswagen Beetle', 'year' => 1965, 'manufacturer' => 'Volkswagen',
            'description' => 'Один из самых узнаваемых автомобилей в истории. Простота, надёжность и очарование.',
            'price' => '22 000 €',
            'image' => 'https://images.unsplash.com/photo-1513178532803-0d3db9cf7696?w=800',
            'features' => json_encode(['Заднемоторная компоновка', 'Оригинальный салон', 'Экономичный', 'Простое обслуживание']),
            'engine' => 'Оппозитный-4 1.2L', 'power' => '40 л.с.', 'transmission' => 'Механическая 4-ст', 'color' => 'Бирюзовый',
        ],
        [
            'name' => 'Chevrolet Corvette C1', 'year' => 1958, 'manufacturer' => 'Chevrolet',
            'description' => 'Первое поколение легендарного американского спорткара с изящными формами.',
            'price' => '85 000 €',
            'image' => 'https://images.unsplash.com/photo-1556025422-158fcdd0bcc3?w=800',
            'features' => json_encode(['Хромированные детали', 'Двухцветный кузов', 'Спортивные сиденья', 'Редкая комплектация']),
            'engine' => 'V8 4.6L', 'power' => '230 л.с.', 'transmission' => 'Механическая 3-ст', 'color' => 'Красный',
        ],
    ];

    $stmt = $pdo->prepare("
        INSERT INTO items (name, year, manufacturer, description, price, image, features, engine, power, transmission, color)
        VALUES (:name, :year, :manufacturer, :description, :price, :image, :features, :engine, :power, :transmission, :color)
    ");

    foreach ($cars as $car) {
        $stmt->execute($car);
    }

    echo "✓ Добавлено " . count($cars) . " автомобилей.\n";
}

function reset_data(PDO $pdo): void
{
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    $pdo->exec("TRUNCATE TABLE feedback_items");
    $pdo->exec("TRUNCATE TABLE feedback");
    $pdo->exec("TRUNCATE TABLE items");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
    echo "✓ Данные очищены.\n";
    seed_cars($pdo);
}

function drop_tables(PDO $pdo): void
{
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    $pdo->exec("DROP TABLE IF EXISTS feedback_items");
    $pdo->exec("DROP TABLE IF EXISTS orders");
    $pdo->exec("DROP TABLE IF EXISTS cars");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
    echo "✓ Таблицы удалены.\n";
}

function stats(PDO $pdo): void
{
    $cars   = $pdo->query("SELECT COUNT(*) FROM items")->fetchColumn();
    $orders = $pdo->query("SELECT COUNT(*) FROM feedback")->fetchColumn();
    $news   = $pdo->query("SELECT COUNT(*) FROM feedback WHERE newsletter = 1")->fetchColumn();

    echo "─────────────────────────────\n";
    echo " RetroAuto — статистика БД\n";
    echo "─────────────────────────────\n";
    echo " Автомобилей: $cars\n";
    echo " Заявок:      $orders\n";
    echo " Подписчиков: $news\n";
    echo "─────────────────────────────\n";
}
