import { useState } from "react";
import { Link, useLocation } from "react-router";
import { toast } from "sonner";
import { useCart } from "../context/CartContext";

export function OrderFormPage() {
  const location = useLocation();
  const { items: contextItems, clearCart } = useCart();

  // Берём товары: из state навигации (кнопка "Оформить" в корзине) или из контекста
  const cartItems: typeof contextItems =
    location.state?.cartItems ?? contextItems;

  const hasCart = cartItems.length > 0;

  const [formData, setFormData] = useState({
    name: "",
    email: "",
    phone: "",
    message: "",
    newsletter: false,
  });

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (!formData.name || !formData.email || !formData.phone) {
      toast.error("Пожалуйста, заполните все обязательные поля");
      return;
    }
    toast.success("Заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.");
    clearCart();
    setFormData({ name: "", email: "", phone: "", message: "", newsletter: false });
  };

  const totalPrice = cartItems.reduce((sum, item) => {
    const price = parseInt(item.price.replace(/[^\d]/g, ""));
    return sum + price * item.quantity;
  }, 0);

  return (
    <div className="py-5 bg-light min-vh-100">
      <div className="container">
        <div className="mx-auto" style={{ maxWidth: "820px" }}>

          <div className="text-center mb-5">
            <h1 className="display-5 fw-bold mb-3">Оставить заявку</h1>
            <p className="fs-5 text-muted">
              Заполните форму, и наш специалист свяжется с вами для обсуждения деталей
            </p>
          </div>

          {/* ===== АВТОМОБИЛИ ИЗ КОРЗИНЫ ===== */}
          {hasCart && (
            <div className="card border-2 border-warning mb-4 shadow-sm">
              <div className="card-header bg-warning bg-opacity-10 d-flex align-items-center gap-2">
                <i className="bi bi-cart-check-fill text-warning fs-5"></i>
                <span className="fw-bold">
                  {cartItems.length === 1
                    ? "Автомобиль в заявке"
                    : `Автомобили в заявке (${cartItems.length})`}
                </span>
              </div>
              <div className="card-body p-0">
                <ul className="list-group list-group-flush">
                  {cartItems.map((item, idx) => (
                    <li key={item.id} className="list-group-item px-4 py-3">
                      <div className="d-flex align-items-center gap-3">
                        {/* Номер */}
                        <span
                          className="badge rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                          style={{
                            width: 28, height: 28,
                            backgroundColor: "var(--ra-gold)",
                            color: "#fff",
                            fontSize: "0.8rem",
                          }}
                        >
                          {idx + 1}
                        </span>
                        {/* Превью */}
                        <img
                          src={item.image}
                          alt={item.name}
                          style={{ width: 64, height: 48, objectFit: "cover", borderRadius: 6, flexShrink: 0 }}
                        />
                        {/* Инфо */}
                        <div className="flex-grow-1">
                          <div className="fw-semibold">{item.name}</div>
                          <div className="small text-muted">
                            {item.manufacturer} • {item.year}
                          </div>
                        </div>
                        {/* Цена */}
                        <div className="text-end flex-shrink-0">
                          <div className="fw-bold" style={{ color: "var(--ra-gold-hover)" }}>
                            {item.price}
                          </div>
                          {item.quantity > 1 && (
                            <div className="small text-muted">× {item.quantity}</div>
                          )}
                        </div>
                      </div>
                    </li>
                  ))}
                </ul>
                {/* Итого при нескольких авто */}
                {cartItems.length > 1 && (
                  <div className="px-4 py-3 d-flex justify-content-between align-items-center bg-light border-top">
                    <span className="fw-semibold text-muted">Общая сумма:</span>
                    <span className="fs-5 fw-bold" style={{ color: "var(--ra-gold-hover)" }}>
                      {totalPrice.toLocaleString()} €
                    </span>
                  </div>
                )}
              </div>
            </div>
          )}

          {/* ===== ФОРМА ===== */}
          <div className="card border-2 shadow">
            <div className="card-header bg-warning bg-opacity-10 border-bottom-0">
              <h2 className="h4 mb-1">Форма заказа</h2>
              <p className="text-muted mb-0 small">
                Поля, отмеченные звёздочкой (*), обязательны для заполнения
              </p>
            </div>
            <div className="card-body p-4">
              <form onSubmit={handleSubmit}>

                <div className="row g-3 mb-4">
                  <div className="col-md-6">
                    <label htmlFor="name" className="form-label d-flex align-items-center gap-2">
                      <i className="bi bi-person text-warning"></i>Ваше имя *
                    </label>
                    <input
                      type="text"
                      className="form-control form-control-lg"
                      id="name"
                      placeholder="Иван Петров"
                      value={formData.name}
                      onChange={(e) => setFormData({ ...formData, name: e.target.value })}
                      required
                    />
                  </div>
                  <div className="col-md-6">
                    <label htmlFor="phone" className="form-label d-flex align-items-center gap-2">
                      <i className="bi bi-telephone text-warning"></i>Телефон *
                    </label>
                    <input
                      type="tel"
                      className="form-control form-control-lg"
                      id="phone"
                      placeholder="+7 (999) 123-45-67"
                      value={formData.phone}
                      onChange={(e) => setFormData({ ...formData, phone: e.target.value })}
                      required
                    />
                  </div>
                </div>

                <div className="mb-4">
                  <label htmlFor="email" className="form-label d-flex align-items-center gap-2">
                    <i className="bi bi-envelope text-warning"></i>Email *
                  </label>
                  <input
                    type="email"
                    className="form-control form-control-lg"
                    id="email"
                    placeholder="ivan@example.com"
                    value={formData.email}
                    onChange={(e) => setFormData({ ...formData, email: e.target.value })}
                    required
                  />
                </div>


                <div className="mb-4">
                  <label htmlFor="message" className="form-label d-flex align-items-center gap-2">
                    <i className="bi bi-chat-left-text text-warning"></i>Сообщение
                  </label>
                  <textarea
                    className="form-control form-control-lg"
                    id="message"
                    rows={4}
                    placeholder="Дополнительные пожелания, вопросы..."
                    value={formData.message}
                    onChange={(e) => setFormData({ ...formData, message: e.target.value })}
                  />
                </div>

                <div className="mb-4 p-3 bg-warning bg-opacity-10 rounded">
                  <div className="form-check">
                    <input
                      className="form-check-input"
                      type="checkbox"
                      id="newsletter"
                      checked={formData.newsletter}
                      onChange={(e) => setFormData({ ...formData, newsletter: e.target.checked })}
                    />
                    <label className="form-check-label" htmlFor="newsletter">
                      Хочу получать новости о новых поступлениях и специальных предложениях
                    </label>
                  </div>
                </div>

                <button type="submit" className="btn btn-warning btn-lg w-100 mb-3">
                  <i className="bi bi-send me-2"></i>
                  {hasCart
                    ? `Отправить заявку на ${cartItems.length} ${cartItems.length === 1 ? "автомобиль" : "автомобиля"}`
                    : "Отправить заявку"}
                </button>

                {hasCart && (
                  <Link to="/cart" className="btn btn-outline-secondary w-100 mb-3">
                    <i className="bi bi-arrow-left me-2"></i>Вернуться в корзину
                  </Link>
                )}

                <p className="small text-muted text-center mb-0">
                  Нажимая «Отправить заявку», вы соглашаетесь с обработкой персональных данных
                </p>
              </form>
            </div>
          </div>

          {/* Контакты */}
          <div className="card mt-4 border-2 border-warning shadow-sm">
            <div className="card-body">
              <h3 className="h5 fw-bold mb-3">Другие способы связи</h3>
              <div className="row g-2">
                <div className="col-sm-4">
                  <p className="d-flex align-items-center gap-2 mb-0">
                    <i className="bi bi-telephone text-warning"></i>+7 (495) 123-45-67
                  </p>
                </div>
                <div className="col-sm-4">
                  <p className="d-flex align-items-center gap-2 mb-0">
                    <i className="bi bi-envelope text-warning"></i>info@retroauto.ru
                  </p>
                </div>
                <div className="col-sm-4">
                  <p className="d-flex align-items-center gap-2 mb-0">
                    <i className="bi bi-clock text-warning"></i>Пн–Пт 10:00–19:00
                  </p>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  );
}
