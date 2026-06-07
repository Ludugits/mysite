export function AboutPage() {
  return (
    <div>
      {/* Hero Section */}
      <section
        className="position-relative py-5 overflow-hidden"
        style={{
          backgroundImage: `url('https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1920')`,
          backgroundSize: "cover",
          backgroundPosition: "center",
          minHeight: "400px",
        }}
      >
        <div className="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-75" />
        <div className="position-relative container text-center py-5" style={{ zIndex: 10 }}>
          <h1 className="display-4 text-white mb-3">О нас</h1>
          <p className="fs-5 text-white-50 mx-auto" style={{ maxWidth: "700px" }}>
            Более 20 лет мы занимаемся тем, что любим — возвращаем к жизни легенды автопрома
          </p>
        </div>
      </section>

      {/* Our Story */}
      <section className="py-5 bg-white">
        <div className="container">
          <div className="row g-4 align-items-center">
            <div className="col-md-6">
              <h2 className="display-6 mb-4">Наша история</h2>
              <div className="text-muted lh-lg">
                <p>
                  RetroAuto была основана в 2006 году группой энтузиастов, влюбленных в классические автомобили 50-х и 60-х годов. Начав с небольшой мастерской и нескольких автомобилей, мы выросли в ведущего дилера ретро автомобилей в регионе.
                </p>
                <p>
                  Наша миссия — сохранить автомобильное наследие и дать возможность ценителям прикоснуться к истории. Каждый автомобиль в нашей коллекции тщательно отобран, отреставрирован и задокументирован.
                </p>
                <p>
                  За годы работы мы помогли сотням коллекционеров найти автомобиль их мечты. От редких европейских родстеров до культовых американских маслкаров — мы специализируемся на самых желанных моделях золотого века автопрома.
                </p>
              </div>
            </div>
            <div className="col-md-6">
              <div className="row g-3">
                <div className="col-6">
                  <div
                    className="rounded"
                    style={{
                      height: "200px",
                      backgroundImage: `url('https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=600')`,
                      backgroundSize: "cover",
                      backgroundPosition: "center",
                    }}
                  />
                </div>
                <div className="col-6">
                  <div
                    className="rounded mt-4"
                    style={{
                      height: "200px",
                      backgroundImage: `url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=600')`,
                      backgroundSize: "cover",
                      backgroundPosition: "center",
                    }}
                  />
                </div>
                <div className="col-6">
                  <div
                    className="rounded"
                    style={{
                      height: "200px",
                      backgroundImage: `url('https://images.unsplash.com/photo-1511407318201-a0168a3d89fe?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=600')`,
                      backgroundSize: "cover",
                      backgroundPosition: "center",
                      marginTop: "-2rem",
                    }}
                  />
                </div>
                <div className="col-6">
                  <div
                    className="rounded"
                    style={{
                      height: "200px",
                      backgroundImage: `url('https://images.unsplash.com/photo-1682884711506-8ccf5ab45ef5?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=600')`,
                      backgroundSize: "cover",
                      backgroundPosition: "center",
                    }}
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Our Values */}
      <section className="py-5 bg-light">
        <div className="container">
          <div className="text-center mb-5">
            <h2 className="display-6 mb-3">Наши ценности</h2>
            <p className="text-muted mx-auto" style={{ maxWidth: "700px" }}>
              Принципы, которыми мы руководствуемся в работе
            </p>
          </div>
          <div className="row g-4">
            {[
              {
                icon: "bi-award",
                title: "Качество",
                desc: "Мы гарантируем высочайшее качество реставрации и подлинность каждого автомобиля",
              },
              {
                icon: "bi-heart",
                title: "Страсть",
                desc: "Мы делаем это не только ради бизнеса — мы по-настоящему любим классические автомобили",
              },
              {
                icon: "bi-people",
                title: "Доверие",
                desc: "Прозрачность во всем — от документации до ценообразования",
              },
              {
                icon: "bi-tools",
                title: "Мастерство",
                desc: "Наша команда — профессионалы с десятилетиями опыта в реставрации",
              },
            ].map(({ icon, title, desc }) => (
              <div key={title} className="col-md-6 col-lg-3">
                <div className="card border-2 h-100">
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

      {/* Team Stats */}
      <section className="py-5 bg-warning">
        <div className="container">
          <div className="row g-4 text-center">
            <div className="col-md-3 col-6">
              <p className="display-4 text-white mb-2">20+</p>
              <p className="text-white text-opacity-75">Лет опыта</p>
            </div>
            <div className="col-md-3 col-6">
              <p className="display-4 text-white mb-2">150+</p>
              <p className="text-white text-opacity-75">Проданных автомобилей</p>
            </div>
            <div className="col-md-3 col-6">
              <p className="display-4 text-white mb-2">30+</p>
              <p className="text-white text-opacity-75">Автомобилей в коллекции</p>
            </div>
            <div className="col-md-3 col-6">
              <p className="display-4 text-white mb-2">15</p>
              <p className="text-white text-opacity-75">Специалистов в команде</p>
            </div>
          </div>
        </div>
      </section>

      {/* Contact Info */}
      <section className="py-5 bg-white">
        <div className="container">
          <div className="text-center mb-5">
            <h2 className="display-6 mb-3">Как нас найти</h2>
            <p className="text-muted">Мы всегда рады видеть вас в нашем шоуруме</p>
          </div>
          <div className="row g-4 mx-auto" style={{ maxWidth: "900px" }}>
            <div className="col-md-4">
              <div className="card border-2 h-100 feature-card">
                <div className="card-body text-center p-4">
                  <div className="feature-icon mb-3">
                    <i className="bi bi-geo-alt"></i>
                  </div>
                  <h5 className="card-title mb-3">Адрес</h5>
                  <p className="card-text small text-muted">
                    ул. Автомобильная, 15<br />
                    Москва, 123456
                  </p>
                </div>
              </div>
            </div>
            <div className="col-md-4">
              <div className="card border-2 h-100 feature-card">
                <div className="card-body text-center p-4">
                  <div className="feature-icon mb-3">
                    <i className="bi bi-telephone"></i>
                  </div>
                  <h5 className="card-title mb-3">Телефон</h5>
                  <p className="card-text small text-muted">
                    +7 (495) 123-45-67<br />
                    Пн-Пт: 10:00 - 19:00
                  </p>
                </div>
              </div>
            </div>
            <div className="col-md-4">
              <div className="card border-2 h-100 feature-card">
                <div className="card-body text-center p-4">
                  <div className="feature-icon mb-3">
                    <i className="bi bi-envelope"></i>
                  </div>
                  <h5 className="card-title mb-3">Email</h5>
                  <p className="card-text small text-muted">
                    info@retroauto.ru<br />
                    sales@retroauto.ru
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}
