import { Link } from "react-router";
import { cars } from "../data/cars";
import { useState, useEffect, useRef } from "react";

const featuredCars = cars.slice(0, 3);

// JavaScript: хук анимации счётчика
function useCounter(target: number, duration = 1500) {
  const [count, setCount] = useState(0);
  const ref = useRef(false);

  useEffect(() => {
    if (ref.current) return;
    ref.current = true;
    const step = Math.ceil(target / (duration / 16));
    let current = 0;
    const timer = setInterval(() => {
      current += step;
      if (current >= target) {
        setCount(target);
        clearInterval(timer);
      } else {
        setCount(current);
      }
    }, 16);
    return () => clearInterval(timer);
  }, [target, duration]);

  return count;
}

function StatsBar() {
  const sold = useCounter(150);
  const years = useCounter(20);
  const happy = useCounter(95);

  return (
    <div className="position-absolute bottom-0 start-0 w-100" style={{ backgroundColor: "rgba(0,0,0,0.6)", backdropFilter: "blur(10px)" }}>
      <div className="container">
        <div className="row py-3">
          <div className="col-4 text-center py-2">
            <p className="display-6 text-warning mb-0">{sold}+</p>
            <p className="small text-white-50 mb-0">Автомобилей продано</p>
          </div>
          <div className="col-4 text-center py-2 border-start border-end border-secondary">
            <p className="display-6 text-warning mb-0">{years}+</p>
            <p className="small text-white-50 mb-0">Лет на рынке</p>
          </div>
          <div className="col-4 text-center py-2">
            <p className="display-6 text-warning mb-0">{happy}%</p>
            <p className="small text-white-50 mb-0">Довольных клиентов</p>
          </div>
        </div>
      </div>
    </div>
  );
}

export function HomePage() {
  return (
    <div>
      {/* Hero Section */}
      <section
        className="position-relative d-flex align-items-center overflow-hidden hero-section"
        style={{
          minHeight: "90vh",
          backgroundImage: `url('https://images.unsplash.com/photo-1697196180794-be968e5c906f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1920')`,
          backgroundSize: "cover",
          backgroundPosition: "center",
        }}
      >
        <div
          className="position-absolute top-0 start-0 w-100 h-100"
          style={{
            background: "linear-gradient(to right, rgba(0,0,0,0.8), rgba(0,0,0,0.5), transparent)",
          }}
        />

        <div className="position-relative container z-1">
          <div style={{ maxWidth: "600px" }}>
            <span className="badge bg-warning text-dark mb-3 px-3 py-2">
              Коллекция 2026
            </span>
            <h1 className="display-3 fw-bold text-white mb-4 lh-sm">
              Легенды <br />
              <span className="text-warning">Автопрома</span>
            </h1>
            <p className="fs-5 text-white-50 mb-4">
              Тщательно отреставрированные классические автомобили 50-х и 60-х годов. Каждый экземпляр — живая история с полной документацией.
            </p>
            <div className="d-flex gap-3 flex-wrap">
              <Link to="/catalog" className="btn btn-warning btn-lg px-4">
                Смотреть каталог
                <i className="bi bi-chevron-right ms-2"></i>
              </Link>
              <Link to="/order" className="btn btn-outline-light btn-lg px-4">
                Оставить заявку
              </Link>
            </div>
          </div>
        </div>

        {/* Stats bar — JavaScript анимированные счётчики */}
        <StatsBar />
      </section>

      {/* Why choose us */}
      <section className="py-5 bg-white">
        <div className="container">
          <div className="text-center mb-5">
            <h2 className="display-5 mb-3">Почему выбирают нас</h2>
            <p className="text-muted" style={{ maxWidth: "600px", margin: "0 auto" }}>
              Более двух десятилетий мы соединяем ценителей с шедеврами классического автопрома
            </p>
          </div>
          <div className="row g-4">
            {[
              {
                icon: "bi-award",
                title: "Экспертность",
                desc: "Более 20 лет опыта в реставрации и продаже классических автомобилей",
              },
              {
                icon: "bi-shield-check",
                title: "Гарантия качества",
                desc: "Полная документация, история обслуживания и гарантия подлинности",
              },
              {
                icon: "bi-car-front",
                title: "Редкие экземпляры",
                desc: "Эксклюзивная коллекция автомобилей со всего мира",
              },
              {
                icon: "bi-tools",
                title: "Реставрация",
                desc: "Профессиональная реставрация с сохранением оригинальности",
              },
            ].map(({ icon, title, desc }) => (
              <div key={title} className="col-md-6 col-lg-3">
                <div className="card h-100 border-0 shadow-sm feature-card">
                  <div className="card-body text-center p-4">
                    <div className="feature-icon mb-3">
                      <i className={icon}></i>
                    </div>
                    <h5 className="card-title mb-3">{title}</h5>
                    <p className="card-text small text-muted">{desc}</p>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Featured Cars */}
      <section className="py-5 bg-light">
        <div className="container">
          <div className="d-flex justify-content-between align-items-end mb-4">
            <div>
              <h2 className="display-5 mb-2">Избранные автомобили</h2>
              <p className="text-muted">Лучшие экземпляры нашей коллекции</p>
            </div>
            <Link to="/catalog" className="d-none d-md-flex align-items-center text-decoration-none text-warning">
              Весь каталог
              <i className="bi bi-chevron-right ms-1"></i>
            </Link>
          </div>

          <div className="row g-4">
            {featuredCars.map((car) => (
              <div key={car.id} className="col-md-6 col-lg-4">
                <div className="card car-card h-100">
                  <div className="position-relative overflow-hidden" style={{ height: "250px" }}>
                    <img
                      src={car.image}
                      alt={car.name}
                      className="car-image w-100 h-100"
                    />
                    <span className="badge bg-warning text-dark position-absolute top-0 end-0 m-3">
                      {car.year}
                    </span>
                  </div>
                  <div className="card-body">
                    <h5 className="card-title mb-1">{car.name}</h5>
                    <p className="card-text small text-muted mb-3">{car.manufacturer}</p>
                    <div className="d-flex gap-3 small text-muted mb-3">
                      <div className="d-flex align-items-center gap-1">
                        <i className="bi bi-calendar"></i>
                        <span>{car.year}</span>
                      </div>
                      <div className="d-flex align-items-center gap-1">
                        <i className="bi bi-speedometer"></i>
                        <span>{car.specs.power}</span>
                      </div>
                    </div>
                    <p className="price-badge mb-3">{car.price}</p>
                  </div>
                  <div className="card-footer bg-white border-0 pb-3">
                    <Link to={`/catalog/${car.id}`} className="btn btn-warning w-100">
                      Подробнее
                    </Link>
                  </div>
                </div>
              </div>
            ))}
          </div>

          <div className="mt-4 text-center d-md-none">
            <Link to="/catalog" className="btn btn-outline-warning">
              Весь каталог
            </Link>
          </div>
        </div>
      </section>

      {/* CTA Banner */}
      <section
        className="position-relative py-5 overflow-hidden"
        style={{
          backgroundImage: `url('https://images.unsplash.com/photo-1642948815603-2358193c3241?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1920')`,
          backgroundSize: "cover",
          backgroundPosition: "center",
          minHeight: "400px",
        }}
      >
        <div className="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-75" />
        <div className="position-relative container text-center py-5" style={{ zIndex: 10 }}>
          <h2 className="display-5 text-white mb-3">Готовы приобрести классику?</h2>
          <p className="fs-5 text-white-50 mb-4" style={{ maxWidth: "700px", margin: "0 auto 2rem" }}>
            Оставьте заявку, и наши эксперты помогут вам выбрать идеальный ретро автомобиль из нашей коллекции
          </p>
          <div className="d-flex gap-3 justify-content-center flex-wrap">
            <Link to="/order" className="btn btn-light btn-lg px-5">
              Оставить заявку
            </Link>
            <Link to="/catalog" className="btn btn-outline-light btn-lg px-5">
              Смотреть каталог
            </Link>
          </div>
        </div>
      </section>
    </div>
  );
}
