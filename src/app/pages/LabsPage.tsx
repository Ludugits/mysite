import React from 'react';

interface LabWork {
  id: number;
  title: string;
  description: string;
  tech: string[];
  status: string;
  badgeBg: string;
}

const labs: LabWork[] = [
  {
    id: 1,
    title: "Лабораторная работа №1",
    description: "Разработка статической структуры веб-страниц и базовая верстка макетов по макету Figma.",
    tech: ["HTML5", "CSS3", "Семантический код"],
    status: "Сдана",
    badgeBg: "bg-success"
  },
  {
    id: 2,
    title: "Лабораторная работа №2",
    description: "Создание адаптивного дизайна и интерактивных компонентов с использованием Bootstrap и медиа-запросов.",
    tech: ["CSS Flexbox/Grid", "Bootstrap 5", "Адаптивность"],
    status: "Сдана",
    badgeBg: "bg-success"
  },
  {
    id: 3,
    title: "Лабораторная работа №3",
    description: "Интеграция клиентской логики на JavaScript: управление корзиной товаров, анимация счетчиков и фильтрация каталога.",
    tech: ["JavaScript (ES6)", "localStorage", "jQuery"],
    status: "Сдана",
    badgeBg: "bg-success"
  },
  {
    id: 4,
    title: "Лабораторная работа №4",
    description: "Разработка серверной части интернет-магазина: создание БД MySQL, вывод каталога из базы данных через PHP PDO.",
    tech: ["PHP 8.x", "MySQL", "PDO Connection"],
    status: "Сдана",
    badgeBg: "bg-success"
  },
  {
    id: 5,
    title: "Лабораторная работа №5",
    description: "Создание системы оформления заказов, отправки AJAX-запросов на сервер и динамического обновления списков.",
    tech: ["AJAX / JSON", "PHP Sessions", "jQuery.ajax"],
    status: "Сдана",
    badgeBg: "bg-success"
  },
  {
    id: 6,
    title: "Лабораторная работа №6 (Текущая)",
    description: "Установка и настройка CMS Joomla, выбор темы оформления, интеграция модуля Virtuemart и создание отчетного документа.",
    tech: ["Joomla CMS", "Virtuemart", "Word (docx) report"],
    status: "В процессе проверки",
    badgeBg: "bg-warning text-dark"
  }
];

export function LabsPage() {
  return (
    <div className="py-5 bg-light min-vh-100">
      <div className="container">
        <div className="mx-auto" style={{ maxWidth: "900px" }}>
          
          <div className="text-center mb-5">
            <span className="badge bg-warning text-dark mb-2 px-3 py-2">Список работ</span>
            <h1 className="display-4 fw-bold mb-3">Лабораторные работы</h1>
            <p className="fs-5 text-muted">Выполненные задания по курсу веб-разработки (студент Гущин С.Д.)</p>
          </div>

          <div className="card border-0 shadow-sm p-4" style={{ borderRadius: "16px" }}>
            <div className="table-responsive">
              <table className="table table-hover align-middle mb-0">
                <thead className="table-light">
                  <tr>
                    <th style={{ width: "80px" }}>№</th>
                    <th>Название темы</th>
                    <th>Описание</th>
                    <th>Стек технологий</th>
                    <th style={{ width: "160px" }}>Статус</th>
                  </tr>
                </thead>
                <tbody>
                  {labs.map((lab) => (
                    <tr key={lab.id} style={{ transition: "background-color 0.2s" }}>
                      <td className="fw-bold text-muted">{lab.id}</td>
                      <td className="fw-bold text-dark">{lab.title}</td>
                      <td className="small text-muted" style={{ maxWidth: "250px" }}>{lab.description}</td>
                      <td>
                        <div className="d-flex flex-wrap gap-1">
                          {lab.tech.map((t) => (
                            <span key={t} className="badge bg-light text-secondary border small">
                              {t}
                            </span>
                          ))}
                        </div>
                      </td>
                      <td>
                        <span className={`badge ${lab.badgeBg} px-3 py-2 w-100 text-center`}>
                          {lab.status}
                        </span>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>

          <div className="mt-4 text-center">
            <a href="#/student" className="btn btn-warning px-4 py-2">
              <i className="bi bi-arrow-left me-2"></i>Вернуться к профилю
            </a>
          </div>

        </div>
      </div>
    </div>
  );
}
