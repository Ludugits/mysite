import { useParams, Link, useNavigate } from "react-router";
import { cars } from "../data/cars";
import { useCart } from "../context/CartContext";
import { toast } from "sonner";

export function CarDetailPage() {
  const { id } = useParams();           // JavaScript: читаем динамический параметр URL
  const navigate = useNavigate();
  const { addToCart } = useCart();

  // JavaScript: находим нужный автомобиль по id из URL
  const car = cars.find((c) => c.id === Number(id));

  // JavaScript: динамически подбираем похожие авто той же марки
  const similar = car
    ? cars.filter((c) => c.manufacturer === car.manufacturer && c.id !== car.id).slice(0, 3)
    : [];

  if (!car) {
    return (
      <div className="container py-5 text-center min-vh-100 d-flex align-items-center justify-content-center">
        <div>
          <div className="empty-state-icon mx-auto mb-4">
            <i className="bi bi-car-front"></i>
          </div>
          <h2 className="display-6 mb-4">Автомобиль не найден</h2>
          <Link to="/catalog" className="btn btn-warning btn-lg">
            Вернуться к каталогу
          </Link>
        </div>
      </div>
    );
  }

  return (
    <div className="py-4 bg-light min-vh-100">
      <div className="container">

        {/* Навигация */}
        <nav aria-label="breadcrumb" className="mb-4">
          <ol className="breadcrumb">
            <li className="breadcrumb-item">
              <Link to="/" className="text-warning text-decoration-none">Главная</Link>
            </li>
            <li className="breadcrumb-item">
              <Link to="/catalog" className="text-warning text-decoration-none">Каталог</Link>
            </li>
            {/* JavaScript: динамическое название в хлебных крошках */}
            <li className="breadcrumb-item active">{car.name}</li>
          </ol>
        </nav>

        <div className="row g-4">
          <div className="col-lg-6">
            <div className="position-relative rounded overflow-hidden shadow-lg">
              <img
                src={car.image}
                alt={car.name}
                className="w-100"
                style={{ height: "500px", objectFit: "cover" }}
              />
              <span className="badge bg-warning text-dark position-absolute top-0 end-0 m-3 fs-6 px-3 py-2">
                {car.year}
              </span>
            </div>
          </div>

          <div className="col-lg-6">
            <div className="bg-white rounded p-4 shadow">
              {/* JavaScript: всё ниже рендерится динамически из объекта car */}
              <h1 className="display-5 fw-bold mb-1">{car.name}</h1>
              <p className="fs-5 text-muted mb-3">{car.manufacturer}</p>

              <hr className="my-3" />

              <p className="text-muted lh-lg mb-4">{car.description}</p>

              <div className="mb-4">
                <p className="display-6 fw-bold mb-1" style={{ color: "var(--ra-gold-hover)" }}>
                  {car.price}
                </p>
                <p className="small text-muted">Цена включает все документы и гарантию</p>
              </div>

              <button
                className="btn btn-warning btn-lg w-100 mb-3"
                onClick={() => {
                  addToCart(car);
                  toast.success(`${car.name} добавлен в корзину`);
                }}
              >
                <i className="bi bi-cart-plus me-2"></i>Добавить в корзину
              </button>

              <Link to="/order" state={{ carName: car.name }} className="d-block mb-3">
                <button className="btn btn-outline-warning btn-lg w-100">
                  Оставить заявку на этот автомобиль
                </button>
              </Link>

              <button
                className="btn btn-outline-secondary btn-lg w-100"
                onClick={() => navigate("/order")}
              >
                <i className="bi bi-telephone me-2"></i>Связаться с консультантом
              </button>
            </div>
          </div>
        </div>

        {/* Характеристики и особенности */}
        <div className="row g-4 mt-2">
          <div className="col-lg-6">
            <div className="card border-2">
              <div className="card-header bg-white">
                <h5 className="mb-0 d-flex align-items-center gap-2">
                  <i className="bi bi-gear text-warning"></i>Технические характеристики
                </h5>
              </div>
              <div className="card-body">
                {/* JavaScript: рендер характеристик из объекта динамически */}
                <ul className="specs-list">
                  {[
                    { icon: "bi-speedometer2", label: "Двигатель", value: car.specs.engine },
                    { icon: "bi-lightning", label: "Мощность", value: car.specs.power },
                    { icon: "bi-gear", label: "Коробка передач", value: car.specs.transmission },
                    { icon: "bi-palette", label: "Цвет", value: car.specs.color },
                    { icon: "bi-calendar", label: "Год выпуска", value: String(car.year) },
                  ].map(({ icon, label, value }) => (
                    <li key={label}>
                      <div className="d-flex align-items-center gap-2 text-muted">
                        <i className={`bi ${icon}`}></i>
                        <span>{label}</span>
                      </div>
                      <span className="fw-semibold">{value}</span>
                    </li>
                  ))}
                </ul>
              </div>
            </div>
          </div>

          <div className="col-lg-6">
            <div className="card border-2">
              <div className="card-header bg-white">
                <h5 className="mb-0 d-flex align-items-center gap-2">
                  <i className="bi bi-check-circle text-warning"></i>Особенности и комплектация
                </h5>
              </div>
              <div className="card-body">
                <ul className="list-unstyled mb-0">
                  {/* JavaScript: массив features рендерится динамически */}
                  {car.features.map((feature, index) => (
                    <li key={index} className="d-flex align-items-start gap-3 mb-3">
                      <i className="bi bi-check-circle-fill text-success mt-1 flex-shrink-0"></i>
                      <span className="text-muted">{feature}</span>
                    </li>
                  ))}
                </ul>
              </div>
            </div>
          </div>
        </div>

        {/* JavaScript: динамически подобранные похожие авто */}
        {similar.length > 0 && (
          <div className="mt-5">
            <h3 className="h4 fw-bold mb-4">
              <i className="bi bi-collection me-2 text-warning"></i>
              Другие автомобили {car.manufacturer}
            </h3>
            <div className="row g-4">
              {similar.map((s) => (
                <div key={s.id} className="col-md-4">
                  <div className="card car-card h-100">
                    <div className="position-relative overflow-hidden" style={{ height: "200px" }}>
                      <img src={s.image} alt={s.name} className="car-image w-100 h-100" />
                      <span className="badge bg-warning text-dark position-absolute top-0 end-0 m-2">
                        {s.year}
                      </span>
                    </div>
                    <div className="card-body">
                      <h6 className="card-title mb-1">{s.name}</h6>
                      <p className="small text-muted mb-2">{s.manufacturer}</p>
                      <p className="fw-bold mb-0" style={{ color: "var(--ra-gold-hover)" }}>{s.price}</p>
                    </div>
                    <div className="card-footer bg-white border-0 pb-3">
                      <Link to={`/catalog/${s.id}`} className="btn btn-warning w-100 btn-sm">
                        Подробнее
                      </Link>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          </div>
        )}

      </div>
    </div>
  );
}
