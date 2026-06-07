import { Link } from "react-router";

export function NotFoundPage() {
  return (
    <div className="container py-5 min-vh-100 d-flex align-items-center justify-content-center">
      <div className="text-center">
        <div className="empty-state-icon mx-auto mb-4">
          <i className="bi bi-car-front"></i>
        </div>
        <h1 className="display-1 fw-bold text-warning">404</h1>
        <h2 className="h3 mb-3 text-dark">Страница не найдена</h2>
        <p className="text-muted mb-4">
          Похоже, этот автомобиль уехал... Страница, которую вы ищете, не существует.
        </p>
        <div className="d-flex gap-3 justify-content-center">
          <Link to="/" className="btn btn-warning btn-lg px-4">
            <i className="bi bi-house me-2"></i>
            На главную
          </Link>
          <Link to="/catalog" className="btn btn-outline-warning btn-lg px-4">
            <i className="bi bi-grid me-2"></i>
            Каталог
          </Link>
        </div>
      </div>
    </div>
  );
}
