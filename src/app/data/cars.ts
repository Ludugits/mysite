export interface Car {
  id: number;
  name: string;
  year: number;
  manufacturer: string;
  description: string;
  price: string;
  image: string;
  features: string[];
  specs: {
    engine: string;
    power: string;
    transmission: string;
    color: string;
  };
}

export const cars: Car[] = [
  {
    id: 1,
    name: "Chevrolet Bel Air",
    year: 1957,
    manufacturer: "Chevrolet",
    description: "Легендарный американский автомобиль эпохи 50-х с характерными плавниками и хромированными деталями. Символ американской мечты и золотого века автопрома.",
    price: "45 000 €",
    image: "https://images.unsplash.com/photo-1620861943958-fc98832e1713?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080",
    features: ["Оригинальная краска", "Хромированные бамперы", "V8 двигатель", "Кожаный салон"],
    specs: { engine: "V8 4.6L", power: "220 л.с.", transmission: "Автоматическая", color: "Голубой" }
  },
  {
    id: 2,
    name: "Mercedes-Benz 190SL",
    year: 1960,
    manufacturer: "Mercedes-Benz",
    description: "Элегантный немецкий родстер с утончённым дизайном и непревзойдённым качеством сборки. Идеальное сочетание стиля и инженерного совершенства.",
    price: "95 000 €",
    image: "https://images.unsplash.com/photo-1576425955345-f48eae74fc44?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080",
    features: ["Откидной верх", "Оригинальные диски", "Редкая модель", "Полная реставрация"],
    specs: { engine: "Рядный-4 1.9L", power: "105 л.с.", transmission: "Механическая 4-ст", color: "Белый" }
  },
  {
    id: 3,
    name: "Ford Mustang Fastback",
    year: 1968,
    manufacturer: "Ford",
    description: "Культовый американский маслкар, представляющий эпоху свободы и мощи. Агрессивный кузов Fastback и ревущий V8 делают его желанным для коллекционеров.",
    price: "65 000 €",
    image: "https://images.unsplash.com/photo-1650634179095-cac904c35b63?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080",
    features: ["Fastback кузов", "Спортивная подвеска", "Оригинальный интерьер", "Документы в порядке"],
    specs: { engine: "V8 5.0L", power: "271 л.с.", transmission: "Механическая 4-ст", color: "Чёрный" }
  },
  {
    id: 4,
    name: "Cadillac Eldorado",
    year: 1959,
    manufacturer: "Cadillac",
    description: "Воплощение американской роскоши и экстравагантности 50-х годов. Огромные плавники и обилие хрома делают его настоящим произведением искусства.",
    price: "78 000 €",
    image: "https://images.unsplash.com/photo-1581163980256-d9581d08d401?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080",
    features: ["Электрические стеклоподъёмники", "Кондиционер", "Кожаный салон", "Хромированные детали"],
    specs: { engine: "V8 6.4L", power: "345 л.с.", transmission: "Автоматическая", color: "Чёрный" }
  },
  {
    id: 5,
    name: "Chevrolet Corvette C1",
    year: 1958,
    manufacturer: "Chevrolet",
    description: "Первое поколение легендарного американского спорткара. Изящные формы и впечатляющая динамика сделали его иконой автомобильного дизайна.",
    price: "85 000 €",
    image: "https://images.unsplash.com/photo-1556025422-158fcdd0bcc3?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080",
    features: ["Хромированные детали", "Двухцветный кузов", "Спортивные сиденья", "Редкая комплектация"],
    specs: { engine: "V8 4.6L", power: "230 л.с.", transmission: "Механическая 3-ст", color: "Чёрный" }
  },
  {
    id: 6,
    name: "Volkswagen Beetle",
    year: 1965,
    manufacturer: "Volkswagen",
    description: "Один из самых узнаваемых автомобилей в истории. Простота, надёжность и очарование делают «Жука» любимцем коллекционеров по всему миру.",
    price: "22 000 €",
    image: "https://images.unsplash.com/photo-1513178532803-0d3db9cf7696?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080",
    features: ["Заднемоторная компоновка", "Оригинальный салон", "Экономичный", "Простое обслуживание"],
    specs: { engine: "Оппозитный-4 1.2L", power: "40 л.с.", transmission: "Механическая 4-ст", color: "Бирюзовый" }
  },
  {
    id: 7,
    name: "Jaguar E-Type",
    year: 1963,
    manufacturer: "Jaguar",
    description: "Признанный одним из красивейших автомобилей всех времён. Стремительные линии кузова и мощный двигатель сделали E-Type легендой мирового автопрома.",
    price: "120 000 €",
    image: "https://images.unsplash.com/photo-1743044771480-773e60701321?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080",
    features: ["Кузов купе", "Независимая подвеска", "Дисковые тормоза", "Оригинальный цвет"],
    specs: { engine: "Рядный-6 3.8L", power: "265 л.с.", transmission: "Механическая 4-ст", color: "Зелёный" }
  },
  {
    id: 8,
    name: "Porsche 356 B",
    year: 1961,
    manufacturer: "Porsche",
    description: "Первый серийный автомобиль Porsche стал основой для всей истории марки. Лёгкий, маневренный и харизматичный — эталон спортивного вождения.",
    price: "110 000 €",
    image: "https://images.unsplash.com/photo-1595521534390-0da06e43ae71?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080",
    features: ["Алюминиевый кузов", "Заднемоторная компоновка", "Спортивный руль", "Полная документация"],
    specs: { engine: "Оппозитный-4 1.6L", power: "90 л.с.", transmission: "Механическая 4-ст", color: "Синий" }
  },
  {
    id: 9,
    name: "Dodge Charger",
    year: 1969,
    manufacturer: "Dodge",
    description: "Икона американского маслкар-движения с агрессивным дизайном и рёвом мощного V8 Hemi. Мечта любого поклонника классических американских автомобилей.",
    price: "72 000 €",
    image: "https://images.unsplash.com/photo-1676919508861-55c8c793b8ff?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080",
    features: ["V8 Hemi двигатель", "Широкий кузов", "Хромированные диски", "Мощная тормозная система"],
    specs: { engine: "V8 7.2L Hemi", power: "375 л.с.", transmission: "Механическая 4-ст", color: "Чёрный" }
  },
];
