import React, { useState, useEffect } from 'react';

export function FeedbackPage() {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    subject: '',
    message: ''
  });
  const [loading, setLoading] = useState(false);
  const [success, setSuccess] = useState(false);

  useEffect(() => {
    // Динамически загружаем скрипт блока «Поделиться» от Яндекса
    const script = document.createElement('script');
    script.src = 'https://yastatic.net/share2/share.js';
    script.async = true;
    document.body.appendChild(script);

    return () => {
      document.body.removeChild(script);
    };
  }, []);

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value
    });
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);

    // Симуляция отправки сообщения по e-mail
    setTimeout(() => {
      setLoading(false);
      setSuccess(true);
      setFormData({ name: '', email: '', subject: '', message: '' });
      setTimeout(() => setSuccess(false), 5000);
    }, 1500);
  };

  return (
    <div className="py-5 bg-light min-vh-100">
      <div className="container">
        <div className="mx-auto" style={{ maxWidth: "700px" }}>
          
          <div className="text-center mb-5">
            <span className="badge bg-warning text-dark mb-2 px-3 py-2">Связь с администратором</span>
            <h1 className="display-4 fw-bold mb-3">Обратная связь</h1>
            <p className="fs-5 text-muted">Отправьте сообщение администратору сайта RetroAuto (Administrator)</p>
          </div>

          {success && (
            <div className="alert alert-success border-0 shadow-sm mb-4 d-flex align-items-center gap-3" role="alert">
              <div className="fs-3">✅</div>
              <div>
                <strong className="d-block">Сообщение отправлено на почту администратора!</strong>
                <span className="small text-muted">Мы свяжемся с вами в ближайшее время. Письмо успешно отправлено.</span>
              </div>
            </div>
          )}

          <div className="card border-0 shadow-sm p-4 mb-4" style={{ borderRadius: "16px" }}>
            <form onSubmit={handleSubmit}>
              <div className="row g-3 mb-3">
                <div className="col-md-6">
                  <label className="form-label fw-bold small text-muted">Ваше имя *</label>
                  <div className="input-group">
                    <span className="input-group-text bg-light border-end-0"><i className="bi bi-person text-warning"></i></span>
                    <input 
                      type="text" 
                      name="name" 
                      className="form-control bg-light border-start-0" 
                      placeholder="Иван Иванов"
                      value={formData.name}
                      onChange={handleChange}
                      required 
                    />
                  </div>
                </div>
                <div className="col-md-6">
                  <label className="form-label fw-bold small text-muted">Email для связи *</label>
                  <div className="input-group">
                    <span className="input-group-text bg-light border-end-0"><i className="bi bi-envelope text-warning"></i></span>
                    <input 
                      type="email" 
                      name="email" 
                      className="form-control bg-light border-start-0" 
                      placeholder="ivan@example.com"
                      value={formData.email}
                      onChange={handleChange}
                      required 
                    />
                  </div>
                </div>
              </div>

              <div className="mb-3">
                <label className="form-label fw-bold small text-muted">Тема сообщения *</label>
                <input 
                  type="text" 
                  name="subject" 
                  className="form-control bg-light" 
                  placeholder="Вопрос по заказу / Предложение"
                  value={formData.subject}
                  onChange={handleChange}
                  required 
                />
              </div>

              <div className="mb-4">
                <label className="form-label fw-bold small text-muted">Текст сообщения *</label>
                <textarea 
                  name="message" 
                  className="form-control bg-light" 
                  rows={5} 
                  placeholder="Введите ваше сообщение здесь..."
                  value={formData.message}
                  onChange={handleChange}
                  required
                ></textarea>
              </div>

              <button 
                type="submit" 
                className="btn btn-warning w-100 py-3 fw-bold" 
                disabled={loading}
              >
                {loading ? (
                  <>
                    <span className="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Отправка на email...
                  </>
                ) : (
                  <>
                    <i className="bi bi-send me-2"></i>Отправить письмо
                  </>
                )}
              </button>
            </form>
          </div>

          {/* Блок «Поделиться» */}
          <div className="card border-0 shadow-sm p-4 text-center" style={{ borderRadius: "16px" }}>
            <h5 className="fw-bold mb-3">Поделиться сайтом в соцсетях:</h5>
            <div className="d-flex justify-content-center">
              <div 
                className="ya-share2" 
                data-curator="true" 
                data-services="messenger,vkontakte,odnoklassniki,telegram,twitter,viber,whatsapp"
              ></div>
            </div>
          </div>

        </div>
      </div>
    </div>
  );
}
