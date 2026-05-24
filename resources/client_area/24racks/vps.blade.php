<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="VPS NVMe en España con Anti-DDoS, acceso root, panel completo y soporte 24/7. Despliegue en menos de 5 minutos.">
    <meta name="theme-color" content="#3b82f6">
    <title>VPS NVMe en España · Anti-DDoS · {{ e(settings('app_name', '24racks Cloud')) }}</title>

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
        .stat-strip { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 1rem; margin-top: 2rem; }
        .stat-strip .metric-card { text-align: center; }
        @media (max-width: 720px) { .stat-strip { grid-template-columns: 1fr; } }

        .compare-grid { display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 1.25rem; margin-top: 2rem; }
        @media (max-width: 720px) { .compare-grid { grid-template-columns: 1fr; } }

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
                        Despliegue en menos de 5 minutos · AS214340
                    </div>

                    <h1 class="hero-title reveal-delay-2">
                        Impulsa tus proyectos con<br>
                        <span class="blue">VPS NVMe en España.</span>
                    </h1>

                    <p class="hero-description reveal-delay-3">
                        Acceso root, recursos claros y una base estable para desplegar servicios sin
                        complicarte con capas innecesarias. NVMe SSD, Anti-DDoS y soporte cercano.
                    </p>

                    <div class="hero-buttons reveal-delay-4">
                        <a href="{{ route('categories.index') }}?type=vps" class="btn btn-primary btn-lg">Ver planes VPS</a>
                        <a href="https://discord.gg/njjhDfYW6m" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-lg">Consultar por Discord</a>
                    </div>

                    <div class="service-chips reveal-delay-4">
                        <span class="service-chip">NVMe SSD</span>
                        <span class="service-chip">Anti-DDoS</span>
                        <span class="service-chip">Panel completo</span>
                        <span class="service-chip">Auto-instalación OS</span>
                        <span class="service-chip">Acceso root</span>
                        <span class="service-chip">Red 1 Gbps</span>
                    </div>
                </div>

                <aside class="technical-panel reveal-delay-3" aria-label="Resumen técnico VPS">
                    <div class="technical-panel-header">
                        <div>
                            <h2 class="technical-panel-title">VPS NVMe</h2>
                            <p class="technical-panel-subtitle">Infraestructura propia · España</p>
                        </div>
                        <span class="panel-status">Operativo</span>
                    </div>
                    <div class="technical-panel-body">
                        <div class="panel-content">
                            <div class="metric-grid">
                                <div class="metric-card">
                                    <p class="metric-label">Uptime</p>
                                    <p class="metric-value">99,9%</p>
                                    <p class="metric-note">Monitorización continua</p>
                                </div>
                                <div class="metric-card">
                                    <p class="metric-label">Red</p>
                                    <p class="metric-value">1 Gbps</p>
                                    <p class="metric-note">Puerto incluido</p>
                                </div>
                                <div class="metric-card">
                                    <p class="metric-label">Soporte</p>
                                    <p class="metric-value">24/7</p>
                                    <p class="metric-note">Equipo técnico</p>
                                </div>
                                <div class="metric-card">
                                    <p class="metric-label">Activación</p>
                                    <p class="metric-value">&lt; 5'</p>
                                    <p class="metric-note">Tras el pago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </section>

        <section class="landing-section reveal-on-scroll" id="features">
            <div class="main-container">
                <div class="section-header">
                    <div class="section-copy">
                        <span class="section-eyebrow">Por qué nuestro VPS</span>
                        <h2 class="section-title">Rendimiento, control y red. Sin sorpresas.</h2>
                        <p class="section-description">
                            Cada VPS está pensado para proyectos que necesitan estabilidad real:
                            discos NVMe, mitigación DDoS y conectividad simétrica desde el primer paquete.
                        </p>
                    </div>
                </div>

                <div class="features-grid">
                    <article class="feature-card reveal-child">
                        <span class="service-icon-wrapper">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 2 4 6v6c0 5 3.5 8 8 10 4.5-2 8-5 8-10V6l-8-4Z"/><path d="m9 12 2 2 4-4"/></svg>
                        </span>
                        <h3 class="feature-title">Control total</h3>
                        <p class="feature-desc">Acceso root completo desde el primer minuto. Instala, configura y administra sin restricciones artificiales.</p>
                    </article>

                    <article class="feature-card reveal-child">
                        <span class="service-icon-wrapper">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M13 2 3 14h8l-1 8 11-13h-8l1-7Z"/></svg>
                        </span>
                        <h3 class="feature-title">Alto rendimiento</h3>
                        <p class="feature-desc">Discos NVMe SSD y CPUs de última generación. Velocidades de lectura/escritura hasta 7× superiores a SSD SATA.</p>
                    </article>

                    <article class="feature-card reveal-child">
                        <span class="service-icon-wrapper">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/></svg>
                        </span>
                        <h3 class="feature-title">Seguridad empresarial</h3>
                        <p class="feature-desc">Protección Anti-DDoS avanzada incluida y entorno aislado para que tu servicio no se vea afectado por terceros.</p>
                    </article>

                    <article class="feature-card reveal-child">
                        <span class="service-icon-wrapper">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 0 20M12 2a15.3 15.3 0 0 0 0 20"/></svg>
                        </span>
                        <h3 class="feature-title">Red 1 Gbps</h3>
                        <p class="feature-desc">Conectividad simétrica de alta velocidad incluida. Sin throttling ni topes ocultos en tu tráfico saliente.</p>
                    </article>

                    <article class="feature-card reveal-child">
                        <span class="service-icon-wrapper">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="6" rx="2"/><rect x="3" y="14" width="18" height="6" rx="2"/><path d="M7 7h.01M7 17h.01"/></svg>
                        </span>
                        <h3 class="feature-title">Panel completo</h3>
                        <p class="feature-desc">Reinstalación de sistema, consola VNC, gestión de red e IPs y backups, todo desde una interfaz clara y rápida.</p>
                    </article>

                    <article class="feature-card reveal-child">
                        <span class="service-icon-wrapper">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 15a4 4 0 0 1-4 4H7l-4 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v8Z"/></svg>
                        </span>
                        <h3 class="feature-title">Soporte 24/7</h3>
                        <p class="feature-desc">Equipo técnico humano disponible cuando algo importa. Sin scripts, sin niveles infinitos antes de llegar a alguien útil.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="dark-band reveal-on-scroll" id="compare">
            <div class="main-container">
                <div class="section-header">
                    <div class="section-copy">
                        <span class="section-eyebrow">Comparativa</span>
                        <h2 class="section-title">VPS o Servidor Dedicado.</h2>
                        <p class="section-description">
                            Empieza con un VPS si necesitas estabilidad y margen para crecer. Salta a dedicado cuando
                            necesites recursos físicos exclusivos.
                        </p>
                    </div>
                </div>

                <div class="compare-grid">
                    <article class="network-card">
                        <div class="network-row"><span>Modelo</span><strong>VPS NVMe</strong></div>
                        <div class="network-row"><span>Activación</span><strong>&lt; 5 min</strong></div>
                        <div class="network-row"><span>Recursos</span><strong>Dedicados al plan</strong></div>
                        <div class="network-row"><span>Red</span><strong>1 Gbps</strong></div>
                        <div class="network-row"><span>Ideal para</span><strong>Webs, paneles, bots, apps</strong></div>
                        <div class="network-row" style="border:0; padding-top:1rem;">
                            <a href="{{ route('categories.index') }}?type=vps" class="btn btn-primary" style="width:100%;justify-content:center;">Ver planes VPS</a>
                        </div>
                    </article>

                    <article class="network-card">
                        <div class="network-row"><span>Modelo</span><strong>Servidor Dedicado</strong></div>
                        <div class="network-row"><span>Activación</span><strong>Bajo aprovisionamiento</strong></div>
                        <div class="network-row"><span>Recursos</span><strong>Hardware exclusivo</strong></div>
                        <div class="network-row"><span>Red</span><strong>Hasta 10 Gbps</strong></div>
                        <div class="network-row"><span>Ideal para</span><strong>Cargas pesadas, grandes comunidades</strong></div>
                        <div class="network-row" style="border:0; padding-top:1rem;">
                            <a href="{{ route('categories.index') }}?type=dedicated" class="btn btn-secondary" style="width:100%;justify-content:center;">Ver dedicados</a>
                        </div>
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
                        <p class="section-description">Lo que más nos preguntan sobre el servicio VPS.</p>
                    </div>
                </div>

                <div class="faq-list">
                    <details class="faq-item">
                        <summary>¿Cuánto tarda el despliegue?</summary>
                        <div>Menos de 5 minutos tras la confirmación del pago. El acceso root y los datos de conexión llegan a tu correo automáticamente.</div>
                    </details>
                    <details class="faq-item">
                        <summary>¿Puedo instalar software personalizado?</summary>
                        <div>Sí. Con acceso root completo puedes instalar, modificar y configurar el sistema sin restricciones.</div>
                    </details>
                    <details class="faq-item">
                        <summary>¿La protección Anti-DDoS está incluida?</summary>
                        <div>Sí, en todos los planes. Mitigación en red 24/7, sin coste adicional ni activación manual.</div>
                    </details>
                    <details class="faq-item">
                        <summary>¿Puedo cambiar de plan más adelante?</summary>
                        <div>Sí, puedes ampliar recursos en cualquier momento desde el área de clientes.</div>
                    </details>
                    <details class="faq-item">
                        <summary>¿Incluye IP dedicada y acceso root?</summary>
                        <div>Sí. Cada VPS lleva una IP dedicada y acceso root completo al sistema operativo.</div>
                    </details>
                    <details class="faq-item">
                        <summary>¿Ofrecéis ayuda con la migración?</summary>
                        <div>Sí. Si vienes de otro proveedor, te asistimos en la migración minimizando el downtime.</div>
                    </details>
                    <details class="faq-item">
                        <summary>¿Qué sistemas operativos puedo instalar?</summary>
                        <div>Distribuciones Linux populares (Debian, Ubuntu, AlmaLinux, Rocky, etc.) instalables desde el panel.</div>
                    </details>
                    <details class="faq-item">
                        <summary>¿Hacéis copias de seguridad automáticas?</summary>
                        <div>Disponible según el plan. Recomendamos activar el servicio de backup automático para mayor tranquilidad.</div>
                    </details>
                </div>

                <div class="cta-band reveal-on-scroll">
                    <div>
                        <h3>¿Listo para arrancar?</h3>
                        <p>Activa tu VPS en menos de 5 minutos, con soporte 24/7 incluido.</p>
                    </div>
                    <a href="{{ route('categories.index') }}?type=vps" class="btn btn-lg">Ver planes VPS</a>
                </div>
            </div>
        </section>
    </main>

    @include('theme::layouts.footer')
</body>
</html>
