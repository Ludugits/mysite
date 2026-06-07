import { useNavigate, Link } from "react-router";
import { useCart } from "../context/CartContext";
import { toast } from "sonner";

export function CartPage() {
  const navigate = useNavigate();
  const { items, removeFromCart, clearCart, getTotalPrice } = useCart();

  const handleRemoveItem = (carId: number, carName: string) => {
    removeFromCart(carId);
    toast.success(`${carName} удалён из корзины`);
  };

  const handleClearCart = () => {
    clearCart();
    toast.success("Корзина очищена");
  };

  const handleCheckout = () => {
    // Передаём товары напрямую через state навигации
    navigate("/order", { state: { cartItems: items } });
  };

  if (items.length === 0) {
    return (
      <div className="container py-5 min-vh-100">
        <div className="text-center mx-auto" style={{ maxWidth: "500px", paddingTop: "5rem" }}>
          <div className="empty-state-icon mb-4">
            <i className="bi bi-cart3"></i>
          </div>
          <h2 className="display-6 mb-3">Корзина пуста</h2>
          <p className="text-muted mb-4">
            Вы ещё не добавили ни одного автомобиля в корзину
          </p>
          <Link to="/catalog" className="btn btn-warning btn-lg">
            Перейти в каталог
          </Link>
        </div>
      </div>
    );
  }

  return (
    <div className="container py-4 min-vh-100">
      <div className="mb-4 d-flex justify-content-between align-items-center">
        <div>
          <h1 className="display-5 mb-2">Корзина</h1>
          <p className="text-muted mb-0">
            {items.length} {items.length === 1 ? "автомобиль" : items.length < 5 ? "автомобиля" : "автомобилей"}
          </p>
        </div>
        <button className="btn btn-outline-danger" onClick={handleClearCart}>
          <i className="bi bi-trash me-2"></i>Очистить корзину
        </button>
      </div>

      <div className="row g-4">
        <div className="col-lg-8">
          <div className="d-flex flex-column gap-3">
            {items.map((item) => (
              <div key={item.id} className="card border-2 cart-item">
                <div className="card-body p-3">
                  <div className="d-flex gap-3">
                    <div
                      className="cart-item-image flex-shrink-0"
                      style={{
                        backgroundImage: `url('${item.image}')`,
                        backgroundSize: "cover",
                        backgroundPosition: "center",
                      }}
                    />
                    <div className="flex-grow-1">
                      <div className="d-flex justify-content-between align-items-start mb-2">
                        <div>
                          <h5 className="mb-1">{item.name}</h5>
                          <p className="small text-muted mb-0">
                            {item.manufacturer} • {item.year}
                          </p>
                        </div>
                        <button
                          className="btn btn-sm btn-outline-danger"
                          onClick={() => handleRemoveItem(item.id, item.name)}
                        >
                          <i className="bi bi-trash"></i>
                        </button>
                      </div>
                      <p className="fs-4 text-warning fw-bold mb-0 mt-2">{item.price}</p>
                    </div>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>

        <div className="col-lg-4">
          <div className="card border-2 sticky-top" style={{ top: "5rem" }}>
            <div className="card-body">
              <h3 className="h5 mb-4">Итого</h3>
              <div className="mb-4">
                <div className="d-flex justify-content-between text-muted mb-2">
                  <span>Автомобилей:</span>
                  <span>{items.length}</span>
                </div>
                <hr />
                <div className="d-flex justify-content-between align-items-center">
                  <span className="fs-5">Общая сумма:</span>
                  <span className="fs-4 text-warning fw-bold">
                    {getTotalPrice().toLocaleString()} €
                  </span>
                </div>
              </div>
              <button
                className="btn btn-warning btn-lg w-100 mb-3"
                onClick={handleCheckout}
              >
                <i className="bi bi-credit-card me-2"></i>
                Оформить заказ
              </button>
              <Link to="/catalog" className="btn btn-outline-warning w-100">
                <i className="bi bi-arrow-left me-2"></i>
                Продолжить покупки
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
