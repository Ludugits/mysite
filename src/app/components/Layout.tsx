import { Link, Outlet, useLocation, useNavigate } from "react-router";
import { useCart } from "../context/CartContext";
import { useEffect } from "react";
import { Logo } from "./Logo";

export function Layout() {
  const location = useLocation();
  const navigate = useNavigate();
  const { getTotalItems } = useCart();
  const totalItems = getTotalItems();

  const isActive = (path: string) =>
    path === "/" ? location.pathname === "/" : location.pathname.startsWith(path);

  useEffect(() => {
    import("bootstrap/dist/js/bootstrap.bundle.min.js");
  }, []);

  const navLinks = [
    { to: "/", label: "Главная", icon: "bi-house" },
    { to: "/catalog", label: "Каталог", icon: "bi-grid" },
    { to: "/student", label: "О себе", icon: "bi-person" },
    { to: "/labs", label: "Лабораторные", icon: "bi-list-check" },
    { to: "/feedback", label: "Обратная связь", icon: "bi-envelope" },
    { to: "/about", label: "О нас", icon: "bi-info-circle" },
    { to: "/order", label: "Заказать", icon: "bi-file-text" },
  ];

  return (
    <div className="d-flex flex-column min-vh-100">

      {/* ===== ШАПКА ===== */}
      <header className="retro-header sticky-top">
        <div className="container">
          <div className="d-flex align-items-center justify-content-between py-2">

            {/* Логотип */}
            <Link to="/" className="d-flex align-items-center gap-2 text-decoration-none">
              <Logo size={44} />
              <div>
                <div className="retro-brand-name">RetroAuto</div>
                <div className="retro-brand-sub">Классика на колёсах</div>
              </div>
            </Link>

            {/* ===== МЕНЮ — всегда видимо ===== */}
            <nav className="d-flex align-items-center gap-1 flex-wrap justify-content-center">
              {navLinks.map(({ to, label, icon }) => (
                <Link
                  key={to}
                  to={to}
                  className={`retro-nav-link${isActive(to) ? " retro-nav-link--active" : ""}`}
                >
                  <i className={`bi ${icon} me-1`}></i>
                  {label}
                </Link>
              ))}

              {/* Корзина */}
              <button
                className="retro-cart-btn position-relative ms-1"
                onClick={() => navigate("/cart")}
              >
                <i className="bi bi-cart3 me-1"></i>
                Корзина
                {totalItems > 0 && (
                  <span className="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {totalItems}
                  </span>
                )}
              </button>
            </nav>

          </div>
        </div>
      </header>

      {/* ===== КОНТЕНТ ===== */}
      <main className="flex-grow-1">
        <Outlet />
      </main>

      {/* ===== ФУТЕР ===== */}
      <footer className="retro-footer mt-auto py-4">
        <div className="container">
          <div className="row g-4">
            <div className="col-md-4">
              <div className="d-flex align-items-center gap-2 mb-3">
                <Logo size={36} />
                <div>
                  <div className="retro-brand-name" style={{ color: "#fff" }}>RetroAuto</div>
                  <div className="retro-brand-sub" style={{ color: "rgba(255,255,255,0.5)" }}>© 2026 Все права защищены</div>
                </div>
              </div>
              <p className="small mb-0" style={{ color: "rgba(255,255,255,0.5)" }}>
                Коллекция редких ретро-автомобилей 50–60-х годов.
              </p>
            </div>

            <div className="col-md-4">
              <h6 className="text-white fw-bold mb-3">Навигация</h6>
              <ul className="list-unstyled mb-0">
                {[...navLinks, { to: "/cart", label: "Корзина", icon: "bi-cart3" }].map(({ to, label }) => (
                  <li key={to} className="mb-1">
                    <Link to={to} className="retro-footer-link">{label}</Link>
                  </li>
                ))}
              </ul>
            </div>

            <div className="col-md-4">
              <h6 className="text-white fw-bold mb-3">Контакты</h6>
              <ul className="list-unstyled mb-0 small" style={{ color: "rgba(255,255,255,0.5)" }}>
                <li className="mb-2"><i className="bi bi-telephone me-2 text-warning"></i>+7 (495) 123-45-67</li>
                <li className="mb-2"><i className="bi bi-envelope me-2 text-warning"></i>info@retroauto.ru</li>
                <li className="mb-2"><i className="bi bi-geo-alt me-2 text-warning"></i>ул. Автомобильная, 15, Москва</li>
                <li><i className="bi bi-clock me-2 text-warning"></i>Пн–Пт: 10:00–19:00</li>
              </ul>
            </div>
          </div>

          <hr className="border-secondary mt-4 mb-3" />
          <p className="text-center small mb-0" style={{ color: "rgba(255,255,255,0.4)" }}>
            Разработано на JavaScript (React) с использованием Bootstrap 5
          </p>
        </div>
      </footer>
    </div>
  );
}
