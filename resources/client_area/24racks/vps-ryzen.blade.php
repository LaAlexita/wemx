<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="VPS con AMD Ryzen 9 5900X, DDR4 y NVMe Gen4 para gaming, paneles y cargas sensibles a latencia. Anti-DDoS incluido.">
    <meta name="theme-color" content="#3b82f6">
    <title>VPS Ryzen 9 · NVMe Gen4 · Anti-DDoS · {{ e(settings('app_name', '24racks Cloud')) }}</title>

    <script>
        (function () {
            const savedTheme = localStorage.getItem('color-theme') || localStorage.getItem('theme') || sessionStorage.getItem('color-theme') || sessionStorage.getItem('theme');
            const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            const theme = savedTheme || (prefersDark ? 'dark' : 'light');

            document.documentElement.dataset.theme = theme;
            document.documentElement.classList.toggle('dark', theme === 'dark');
        })();
    </script>

    <link rel="stylesheet" href="{{ client_asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ client_asset('css/landing.css') }}">
    <script src="{{ client_asset('js/app.js') }}" defer></script>
    <link rel="icon" href="{{ e(settings('favicon', '/assets/core/img/logo.png')) }}" type="image/png">

    <style>
        .compare-grid { display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 1.25rem; margin-top: 2rem; }
        @media (max-width: 720px) { .compare-grid { grid-template-columns: 1fr; } }

        .testimonial-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1rem; margin-top: 1.5rem; }
        .testimonial-card { padding: 1.25rem; border-radius: 14px; border: 1px solid rgba(0,0,0,.08); background: var(--paper, #fff); }
        :root.dark .testimonial-card { border-color: rgba(255,255,255,.08); background: rgba(255,255,255,.02); }
        .testimonial-stars { color: #f59e0b; letter-spacing: 2px; font-size: .95rem; margin-bottom: .5rem; }
        .testimonial-text { line-height: 1.55; opacity: .9; }
        .testimonial-author { margin-top: .75rem; font-weight: 600; font-size: .9rem; opacity: .75; }
        .rating-summary { display: flex; align-items: center; gap: 1rem; flex-wrap: wrap; margin-top: 1rem; }
        .rating-pill { display: inline-flex; align-items: center; gap: .5rem; padding: .5rem .9rem; border-radius: 999px; background: rgba(59,130,246,.1); color: #1d4ed8; font-weight: 600; font-size: .9rem; }
        :root.dark .rating-pill { background: rgba(59,130,246,.18); color: #93c5fd; }

        .faq-list { display: flex; flex-direction: column; gap: .75rem; margin-top: 1.5rem; }
        .faq-item { border: 1px solid rgba(0,0,0,.08); border-radius: 14px; background: var(--paper, #fff); padding: 0; overflow: hidden; }
        :root.dark .faq-item { border-color: rgba(255,255,255,.08); background: rgba(255,255,255,.02); }
        .faq-item > summary { list-style: none; cursor: pointer; padding: 1rem 1.25rem; font-weight: 600; display: flex; align-items: center; justify-content: space-between; gap: 1rem; }
        .faq-item > summary::-webkit-details-marker { display: none; }
        .faq-item > summary::after { content: '+'; font-size: 1.25rem; line-height: 1; opacity: .6; transition: transform .2s ease; }
        .faq-item[open] > summary::after { content: '−'; transform: rotate(180deg); }
        .faq-item > div { padding: 0 1.25rem 1.1rem; opacity: .85; line-height: 1.55; }

        .cta-band { margin-top: 2rem; padding: 2rem; border-radius: 18px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: #fff; display: flex; align-items: center; justify-content: space-between; gap: 1.5rem; flex-wrap: wrap; }
        .cta-band h3 { font-size: 1.5rem; font-weight: 700; margin: 0 0 .25rem; }
        .cta-band p { margin: 0; opacity: .9; }
        .cta-band .btn { background: #fff; color: #1d4ed8; border-color: #fff; }
    </style>
</head>
<body class="landing-page">
    <div class="site-loader" aria-hidden="true"></div>

    @include('theme::layouts.landing-header')

    <main>
        <section class="hero">
            <div class="main-container hero-layout">
                <div class="hero-copy">
                    <div class="hero-kicker reveal-delay-1">
                        <span class="pulse-dot"></span>
                        Ryzen 9 5900X · NVMe Gen4 · Anti-DDoS
                    </div>

                    <h1 class="hero-title reveal-delay-2">
                        VPS Ryzen.<br>
                        <span class="blue">Más velocidad por núcleo.</span>
                    </h1>

                    <p class="hero-description reveal-delay-3">
                        VPS con AMD Ryzen 9 5900X, DDR4 y NVMe Gen4 pensados para gaming, paneles
                        y cargas de producción donde la latencia y el rendimiento por núcleo importan.
                    </p>

                    <div class="hero-buttons reveal-delay-4">
                        <a href="{{ route('categories.index') }}?type=vps" class="btn btn-primary btn-lg">Ver planes Ryzen</a>
                        <a href="https://discord.gg/njjhDfYW6m" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-lg">Contactar con soporte</a>
                    </div>

                    <div class="service-chips reveal-delay-4">
                        <span class="service-chip">Ryzen 9 5900X</span>
                        <span class="service-chip">DDR4 3200 MHz</span>
                        <span class="service-chip">NVMe Gen4</span>
                        <span class="service-chip">Anti-DDoS</span>
                        <span class="service-chip">Red 1 Gbps</span>
                        <span class="service-chip">Activación &lt; 5 min</span>
                    </div>
                </div>

                <aside class="technical-panel reveal-delay-3" aria-label="Resumen técnico VPS Ryzen">
                    <div class="technical-panel-header">
                        <div>
                            <h2 class="technical-panel-title">AMD Ryzen 9 5900X</h2>
                            <p class="technical-panel-subtitle">Hasta 4,8 GHz turbo</p>
                        </div>
                        <span class="panel-status">Operativo</span>
                    </div>
                    <div class="technical-panel-body">
                        <div class="panel-content">
                            <div class="metric-grid">
                                <div class="metric-card">
                                    <p class="metric-label">CPU turbo</p>
                                    <p class="metric-value">4,8 GHz</p>
                                    <p class="metric-note">Ryzen 9 5900X</p>
                                </div>
                                <div class="metric-card">
                                    <p class="metric-label">NVMe Gen4</p>
                                    <p class="metric-value">7 GB/s</p>
                                    <p class="metric-note">Lectura/escritura</p>
                                </div>
                                <div class="metric-card">
                                    <p class="metric-label">Memoria</p>
                                    <p class="metric-value">DDR4</p>
                                    <p class="metric-note">3200 MHz</p>
                                </div>
                                <div class="metric-card">
                                    <p class="metric-label">Red</p>
                                    <p class="metric-value">1 Gbps</p>
                                    <p class="metric-note">Simétrico</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </section>

        <section class="landing-section reveal-on-scroll" id="why-ryzen">
            <div class="main-container">
                <div class="section-header">
                    <div class="section-copy">
                        <span class="section-eyebrow">¿Por qué VPS Ryzen?</span>
                        <h2 class="section-title">Más rendimiento por núcleo, menos latencia.</h2>
                        <p class="section-description">
                            Para servicios donde cada milisegundo cuenta: gaming, paneles de control,
                            comunidades en directo y aplicaciones con carga concurrente.
                        </p>
                    </div>
                </div>

                <div class="features-grid">
                    <article class="feature-card reveal-child">
                        <span class="service-icon-wrapper">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M13 2 3 14h8l-1 8 11-13h-8l1-7Z"/></svg>
                        </span>
                        <h3 class="feature-title">Rendimiento extremo</h3>
                        <p class="feature-desc">AMD Ryzen 9 5900X con turbo de hasta 4,8 GHz. Excelente rendimiento single-thread para cargas exigentes.</p>
                    </article>

                    <article class="feature-card reveal-child">
                        <span class="service-icon-wrapper">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="6" width="18" height="12" rx="2"/><path d="M7 10v4M11 10v4M15 10v4M19 10v4"/></svg>
                        </span>
                        <h3 class="feature-title">Memoria DDR4</h3>
                        <p class="feature-desc">DDR4 a 3200 MHz. Acceso rápido a memoria con baja latencia para mantener servicios responsivos bajo presión.</p>
                    </article>

                    <article class="feature-card reveal-child">
                        <span class="service-icon-wrapper">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="4" y="3" width="16" height="18" rx="2"/><path d="M8 7h8M8 11h8M8 15h4"/></svg>
                        </span>
                        <h3 class="feature-title">SSD NVMe Gen4</h3>
                        <p class="feature-desc">Hasta 7000 MB/s de lectura/escritura. Tiempos de carga reales para bases de datos, sites y mundos de juego.</p>
                    </article>

                    <article class="feature-card reveal-child">
                        <span class="service-icon-wrapper">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/></svg>
                        </span>
                        <h3 class="feature-title">Protección Anti-DDoS</h3>
                        <p class="feature-desc">Anti-DDoS profesional incluido en todos los planes. Mitigación en red, sin coste adicional ni configuración manual.</p>
                    </article>

                    <article class="feature-card reveal-child">
                        <span class="service-icon-wrapper">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 0 20M12 2a15.3 15.3 0 0 0 0 20"/></svg>
                        </span>
                        <h3 class="feature-title">Conectividad premium</h3>
                        <p class="feature-desc">Puerto simétrico 1 Gbit/s garantizado. Backbone propio AS214340 con peering directo hacia los principales puntos.</p>
                    </article>

                    <article class="feature-card reveal-child">
                        <span class="service-icon-wrapper">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                        </span>
                        <h3 class="feature-title">Activación instantánea</h3>
                        <p class="feature-desc">Despliegue en menos de 5 minutos con acceso root completo. Listo para usar desde el primer correo de confirmación.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="dark-band reveal-on-scroll" id="compare">
            <div class="main-container">
                <div class="section-header">
                    <div class="section-copy">
                        <span class="section-eyebrow">VPS Xeon vs VPS Ryzen</span>
                        <h2 class="section-title">¿Cuál encaja mejor con tu proyecto?</h2>
                        <p class="section-description">
                            Ryzen ofrece mayor velocidad por núcleo y mejor comportamiento bajo cargas concurrentes.
                            Xeon mantiene rendimiento adecuado para proyectos estándar.
                        </p>
                    </div>
                </div>

                <div class="compare-grid">
                    <article class="network-card">
                        <div class="network-row"><span>Plataforma</span><strong>VPS Ryzen</strong></div>
                        <div class="network-row"><span>CPU</span><strong>Ryzen 9 5900X · 4,8 GHz</strong></div>
                        <div class="network-row"><span>Almacenamiento</span><strong>NVMe Gen4 · 7 GB/s</strong></div>
                        <div class="network-row"><span>Ideal para</span><strong>Gaming, paneles, latencia baja</strong></div>
                        <div class="network-row"><span>Rendimiento por núcleo</span><strong>Máximo</strong></div>
                        <div class="network-row" style="border:0; padding-top:1rem;">
                            <a href="{{ route('categories.index') }}?type=vps" class="btn btn-primary" style="width:100%;justify-content:center;">Ver planes Ryzen</a>
                        </div>
                    </article>

                    <article class="network-card">
                        <div class="network-row"><span>Plataforma</span><strong>VPS Xeon</strong></div>
                        <div class="network-row"><span>CPU</span><strong>Xeon multi-core</strong></div>
                        <div class="network-row"><span>Almacenamiento</span><strong>NVMe SSD</strong></div>
                        <div class="network-row"><span>Ideal para</span><strong>Webs, apps, servicios estándar</strong></div>
                        <div class="network-row"><span>Rendimiento sostenido</span><strong>Equilibrado</strong></div>
                        <div class="network-row" style="border:0; padding-top:1rem;">
                            <a href="/vps" class="btn btn-secondary" style="width:100%;justify-content:center;">Ver planes VPS Xeon</a>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="landing-section reveal-on-scroll" id="reviews">
            <div class="main-container">
                <div class="section-header">
                    <div class="section-copy">
                        <span class="section-eyebrow">Opiniones de clientes</span>
                        <h2 class="section-title">Lo que dicen quienes ya nos usan.</h2>
                        <div class="rating-summary">
                            <span class="rating-pill">★ 4,8 / 5 · 61 valoraciones</span>
                            <span class="rating-pill">Trustpilot 99%</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-grid">
                    <article class="testimonial-card reveal-child">
                        <div class="testimonial-stars" aria-label="5 estrellas">★★★★★</div>
                        <p class="testimonial-text">"Rendimiento muy bueno y soporte rápido. Migramos el panel y los tiempos de respuesta bajaron al instante."</p>
                        <p class="testimonial-author">— Makiavelik</p>
                    </article>

                    <article class="testimonial-card reveal-child">
                        <div class="testimonial-stars" aria-label="5 estrellas">★★★★★</div>
                        <p class="testimonial-text">"Activación inmediata y la red aguanta sin problema. Se nota la diferencia con otros proveedores que probé antes."</p>
                        <p class="testimonial-author">— Patricio Rojas</p>
                    </article>

                    <article class="testimonial-card reveal-child">
                        <div class="testimonial-stars" aria-label="5 estrellas">★★★★★</div>
                        <p class="testimonial-text">"Soporte cercano y técnico. Resolvieron una incidencia de configuración en minutos, sin pasar por scripts ni colas eternas."</p>
                        <p class="testimonial-author">— Roberto Seguro</p>
                    </article>

                    <article class="testimonial-card reveal-child">
                        <div class="testimonial-stars" aria-label="5 estrellas">★★★★★</div>
                        <p class="testimonial-text">"Llevamos meses con varios VPS Ryzen y el rendimiento es muy estable. Mitigación DDoS funcionando cuando ha tocado."</p>
                        <p class="testimonial-author">— Arkadya Corp</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="landing-section reveal-on-scroll" id="faq">
            <div class="main-container">
                <div class="section-header">
                    <div class="section-copy">
                        <span class="section-eyebrow">Preguntas frecuentes</span>
                        <h2 class="section-title">Antes de contratar.</h2>
                        <p class="section-description">Lo que más nos preguntan sobre el servicio VPS Ryzen.</p>
                    </div>
                </div>

                <div class="faq-list">
                    <details class="faq-item">
                        <summary>¿Cuánto tarda el despliegue?</summary>
                        <div>Menos de 5 minutos tras la confirmación del pago. Recibes los accesos por correo de forma automática.</div>
                    </details>
                    <details class="faq-item">
                        <summary>¿Puedo instalar software personalizado?</summary>
                        <div>Sí, con acceso root completo puedes instalar y configurar el sistema como necesites.</div>
                    </details>
                    <details class="faq-item">
                        <summary>¿La protección Anti-DDoS está incluida?</summary>
                        <div>Sí, en todos los planes VPS Ryzen, sin coste adicional.</div>
                    </details>
                    <details class="faq-item">
                        <summary>¿Puedo cambiar de plan más adelante?</summary>
                        <div>Sí, puedes ampliar recursos en cualquier momento desde el panel de control.</div>
                    </details>
                    <details class="faq-item">
                        <summary>¿Incluye IP dedicada y acceso root?</summary>
                        <div>Sí, IP dedicada y acceso root completo desde el primer minuto.</div>
                    </details>
                    <details class="faq-item">
                        <summary>¿Ofrecéis ayuda con la migración?</summary>
                        <div>Sí, te ayudamos a migrar desde otro proveedor minimizando el tiempo de inactividad.</div>
                    </details>
                    <details class="faq-item">
                        <summary>¿Qué sistemas operativos hay disponibles?</summary>
                        <div>Distribuciones Linux populares y plantillas optimizadas para producción.</div>
                    </details>
                    <details class="faq-item">
                        <summary>¿Hacéis copias de seguridad automáticas?</summary>
                        <div>Disponible según el plan. Recomendamos activar el backup automático para mayor tranquilidad.</div>
                    </details>
                </div>

                <div class="cta-band reveal-on-scroll">
                    <div>
                        <h3>¿Listo para dar el salto a Ryzen?</h3>
                        <p>Nuestro equipo está disponible 24/7 para ayudarte a elegir el plan que mejor encaja.</p>
                    </div>
                    <a href="{{ route('categories.index') }}?type=vps" class="btn btn-lg">Ver planes Ryzen</a>
                </div>
            </div>
        </section>
    </main>

    @include('theme::layouts.footer')
</body>
</html>
