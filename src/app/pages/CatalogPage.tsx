import { useState, useMemo } from "react";
import { Link } from "react-router";
import { cars } from "../data/cars";
import { useCart } from "../context/CartContext";
import { toast } from "sonner";

// Получаем уникальные марки через JavaScript
const manufacturers = ["Все", ...Array.from(new Set(cars.map((c) => c.manufacturer))).sort()];

export function CatalogPage() {
  const { addToCart } = useCart();

  // JavaScript: состояние поиска и фильтра
  const [search, setSearch] = useState("");
  const [selectedMaker, setSelectedMaker] = useState("Все");
  const [sortBy, setSortBy] = useState("default");

  // JavaScript: фильтрация и сортировка через useMemo
  const filtered = useMemo(() => {
    let result = cars.filter((car) => {
      const matchSearch =
        car.name.toLowerCase().includes(search.toLowerCase()) ||
        car.manufacturer.toLowerCase().includes(search.toLowerCase());
      const matchMaker = selectedMaker === "Все" || car.manufacturer === selectedMaker;
      return matchSearch && matchMaker;
    });

    // JavaScript: сортировка
    if (sortBy === "price-asc") {
      result = result.sort((a, b) =>
        parseInt(a.price.replace(/[^\d]/g, "")) - parseInt(b.price.replace(/[^\d]/g, ""))
      );
    } else if (sortBy === "price-desc") {
      result = result.sort((a, b) =>
        parseInt(b.price.replace(/[^\d]/g, "")) - parseInt(a.price.replace(/[^\d]/g, ""))
      );
    } else if (sortBy === "year-desc") {
      result = result.sort((a, b) => b.year - a.year);
    } else if (sortBy === "year-asc") {
      result = result.sort((a, b) => a.year - b.year);
    }

    return result;
  }, [search, selectedMaker, sortBy]);

  // JavaScript: сброс фильтров
  const resetFilters = () => {
    setSearch("");
    setSelectedMaker("Все");
    setSortBy("default");
  };

  const hasFilters = search !== "" || selectedMaker !== "Все" || sortBy !== "default";

  return (
    <div className="py-5 bg-light min-vh-100">
      <div className="container">
        <div className="text-center mb-5">
          <h1 className="display-4 fw-bold mb-3">Каталог Ретро Автомобилей</h1>
          <p className="fs-5 text-muted" style={{ maxWidth: "700px", margin: "0 auto" }}>
            Эксклюзивная коллекция из {cars.length} классических автомобилей 50–60-х годов.
          </p>
        </div>

        {/* ===== ФИЛЬТРЫ (JavaScript) ===== */}
        <div className="card border-2 mb-4 shadow-sm">
          <div className="card-body">
            <div className="row g-3 align-items-end">
              {/* Поиск */}
              <div className="col-md-4">
                <label className="form-label fw-semibold">
                  <i className="bi bi-search me-1 text-warning"></i>Поиск
                </label>
                <input
                  type="text"
                  className="form-control"
                  placeholder="Название или марка..."
                  value={search}
                  onChange={(e) => setSearch(e.target.value)}
                />
              </div>

              {/* Фильтр по марке */}
              <div className="col-md-3">
                <label className="form-label fw-semibold">
                  <i className="bi bi-funnel me-1 text-warning"></i>Марка
                </label>
                <select
                  className="form-select"
                  value={selectedMaker}
                  onChange={(e) => setSelectedMaker(e.target.value)}
                >
                  {manufacturers.map((m) => (
                    <option key={m} value={m}>{m}</option>
                  ))}
                </select>
              </div>

              {/* Сортировка */}
              <div className="col-md-3">
                <label className="form-label fw-semibold">
                  <i className="bi bi-sort-down me-1 text-warning"></i>Сортировка
                </label>
                <select
                  className="form-select"
                  value={sortBy}
                  onChange={(e) => setSortBy(e.target.value)}
                >
                  <option value="default">По умолчанию</option>
                  <option value="price-asc">Цена: от низкой</option>
                  <option value="price-desc">Цена: от высокой</option>
                  <option value="year-desc">Год: новее</option>
                  <option value="year-asc">Год: старше</option>
                </select>
              </div>

              {/* Сброс */}
              <div className="col-md-2">
                <button
                  className="btn btn-outline-secondary w-100"
                  onClick={resetFilters}
                  disabled={!hasFilters}
                >
                  <i className="bi bi-x-circle me-1"></i>Сброс
                </button>
              </div>
            </div>
          </div>
        </div>

        {/* Счётчик результатов */}
        <div className="d-flex justify-content-between align-items-center mb-3">
          <p className="text-muted mb-0">
            Найдено: <strong>{filtered.length}</strong> из {cars.length} автомобилей
          </p>
          {hasFilters && (
            <span className="badge bg-warning text-dark">Применены фильтры</span>
          )}
        </div>

        {/* Список авто */}
        {filtered.length === 0 ? (
          <div className="text-center py-5">
            <div className="empty-state-icon mx-auto mb-4">
              <i className="bi bi-search"></i>
            </div>
            <h4>Ничего не найдено</h4>
            <p className="text-muted">Попробуйте изменить параметры поиска</p>
            <button className="btn btn-warning" onClick={resetFilters}>
              Сбросить фильтры
            </button>
          </div>
        ) : (
          <div className="row g-4">
            {filtered.map((car) => (
              <div key={car.id} className="col-md-6 col-lg-4">
                <div className="card car-card h-100">
                  <div className="position-relative overflow-hidden" style={{ height: "250px" }}>
                    <img src={car.image} alt={car.name} className="car-image w-100 h-100" />
                    <span className="badge bg-warning text-dark position-absolute top-0 end-0 m-3">
                      {car.year}
                    </span>
                  </div>

                  <div className="card-body">
                    <h5 className="card-title mb-2">{car.name}</h5>
                    <p className="card-text small text-muted mb-3">{car.manufacturer}</p>
                    <div className="d-flex gap-3 small text-muted mb-3">
                      <span><i className="bi bi-calendar me-1"></i>{car.year}</span>
                      <span><i className="bi bi-speedometer me-1"></i>{car.specs.power}</span>
                    </div>
                    <p className="small text-muted mb-3" style={{
                      overflow: "hidden", textOverflow: "ellipsis",
                      display: "-webkit-box", WebkitLineClamp: 2, WebkitBoxOrient: "vertical",
                    }}>
                      {car.description}
                    </p>
                    <p className="price-badge mb-0">{car.price}</p>
                  </div>

                  <div className="card-footer bg-white border-0 p-3 d-flex gap-2">
                    <Link to={`/catalog/${car.id}`} className="flex-grow-1">
                      <button className="btn btn-warning w-100">Подробнее</button>
                    </Link>
                    <button
                      className="btn btn-outline-warning"
                      title="В корзину"
                      onClick={() => {
                        addToCart(car);
                        toast.success(`${car.name} добавлен в корзину`);
                      }}
                    >
                      <i className="bi bi-cart-plus"></i>
                    </button>
                  </div>
                </div>
              </div>
            ))}
          </div>
        )}
      </div>
    </div>
  );
}
