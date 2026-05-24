<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="24racks Cloud: VPS, dedicados y game hosting en España con Anti-DDoS y soporte técnico cercano.">
    <meta name="theme-color" content="#3b82f6">
    <title>{{ e(settings('app_name', '24racks Cloud')) }}</title>

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
</head>
<body class="landing-page">
    <div class="site-loader" aria-hidden="true"></div>
    @include('theme::layouts.landing-header')

    <main>
        <section class="hero hero-centered">
            <div class="hero-bg" aria-hidden="true">
                <div class="hero-bg-aurora"></div>
                <div class="hero-bg-fade"></div>
            </div>

            <div class="main-container hero-stack">
                <a href="#antiddos-section" class="hero-announce reveal-delay-1">
                    <span class="hero-announce-tag">Anti-DDoS</span>
                    <span class="hero-announce-text">Mitigación activa en toda la red</span>
                    <span class="hero-announce-divider" aria-hidden="true"></span>
                    <span class="hero-announce-arrow" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14M13 6l6 6-6 6"/>
                        </svg>
                    </span>
                </a>

                <h1 class="hero-title hero-title-center reveal-delay-2">
                    Hosting que responde,<br>
                    <span class="blue">red que aguanta.</span>
                </h1>

                <p class="hero-description hero-description-center reveal-delay-3">
                    VPS, dedicados y servidores de juego sobre infraestructura en España,
                    con Anti-DDoS, activación rápida y soporte técnico de verdad.
                </p>

                <div class="hero-buttons hero-buttons-center reveal-delay-4">
                    <a href="#vps-section" class="btn btn-hero-primary btn-lg">Empezar ahora</a>
                    <a href="https://discord.gg/njjhDfYW6m" target="_blank" rel="noopener noreferrer" class="btn btn-hero-ghost btn-lg">
                        Hablar con soporte
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="m9 6 6 6-6 6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <section class="landing-section reveal-on-scroll" id="advantages">
            <div class="main-container">
                <div class="section-header">
                    <div class="section-copy">
                        <span class="section-eyebrow">Infraestructura real</span>
                        <h2 class="section-title">Que se note que detrás hay red, máquinas y soporte.</h2>
                        <p class="section-description">
                            Montamos servicios para proyectos que necesitan estabilidad sin perder el trato directo cuando algo importa.
                        </p>
                    </div>
                </div>

                <div class="features-grid">
                    <article class="feature-card reveal-child">
                        <span class="service-icon-wrapper">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M13 2 3 14h8l-1 8 11-13h-8l1-7Z"/></svg>
                        </span>
                        <h3 class="feature-title">Red estable</h3>
                        <p class="feature-desc">Conectividad preparada para webs, paneles, bots, comunidades y servidores de juego con carga real.</p>
                    </article>

                    <article class="feature-card reveal-child">
                        <span class="service-icon-wrapper">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/></svg>
                        </span>
                        <h3 class="feature-title">Anti-DDoS</h3>
                        <p class="feature-desc">Protección pensada para mantener servicios online cuando llegan picos de tráfico que no deberían estar ahí.</p>
                    </article>

                    <article class="feature-card reveal-child">
                        <span class="service-icon-wrapper">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 15a4 4 0 0 1-4 4H7l-4 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v8Z"/></svg>
                        </span>
                        <h3 class="feature-title">Soporte técnico</h3>
                        <p class="feature-desc">Soporte cercano para resolver incidencias, revisar configuraciones y hablar claro cuando toca tomar decisiones.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="scroll-showcase" id="showcase-section" aria-label="Panel de cliente 24racks">
            <div class="scroll-showcase-container">
                <div class="scroll-showcase-sticky">
                    <header class="scroll-showcase-title">
                        <span class="scroll-showcase-eyebrow">Tu panel · 24racks</span>
                        <h2>
                            Controlas todo<br>
                            <span class="blue">desde un único panel.</span>
                        </h2>
                    </header>

                    <div class="scroll-showcase-frame" aria-hidden="true">
                        <div class="scroll-showcase-card terminal-card">
                            <div class="terminal-titlebar">
                                <span class="terminal-dot terminal-dot-r"></span>
                                <span class="terminal-dot terminal-dot-y"></span>
                                <span class="terminal-dot terminal-dot-g"></span>
                                <span class="terminal-title">root@24racks — ssh · vps-mad-08</span>
                                <span class="terminal-spacer"></span>
                            </div>

                            <div class="terminal-body">
                                <p class="t-line"><span class="t-prompt">$</span> <span class="t-cmd">24racks</span> <span class="t-sub">deploy</span> <span class="t-arg">--plan</span> <span class="t-val">vps-ryzen-9</span> <span class="t-arg">--region</span> <span class="t-val">es-mad</span></p>
                                <p class="t-line t-mute">↳ verifying account · admin@24racks.com</p>
                                <p class="t-line"><span class="t-ok">✔</span> Allocating <span class="t-hl">Ryzen 9 5900X</span> · 16 GB DDR4 3200</p>
                                <p class="t-line"><span class="t-ok">✔</span> Mounting NVMe Gen4 · 250 GB</p>
                                <p class="t-line"><span class="t-ok">✔</span> Assigning IPv4 · <span class="t-hl">92.113.40.184</span></p>
                                <p class="t-line"><span class="t-ok">✔</span> Anti-DDoS shield · L3 / L4 / L7 <span class="t-tag">active</span></p>
                                <p class="t-line"><span class="t-ok">✔</span> Bootstrapping image · <span class="t-hl">debian-13</span></p>
                                <p class="t-line"><span class="t-ok">✔</span> Network up · 1 Gbps simétrico · <span class="t-hl">AS214340</span></p>
                                <p class="t-line">&nbsp;</p>
                                <p class="t-line t-brand">✔ Deployed in 12.3s · vps-mad-08.24racks.com</p>
                                <p class="t-line">&nbsp;</p>
                                <p class="t-line">
                                    <span class="t-prompt">root@vps-mad-08</span><span class="t-mute"> </span><span class="t-path">~</span><span class="t-mute"> # </span><span class="t-typed">tail -f /var/log/ddos/mitigated.log</span><span class="t-cursor"></span>
                                </p>
                                <p class="t-line t-mute">→ 21:48:14  blocked UDP flood · 412 Gbps · src=mixed/global</p>
                                <p class="t-line t-mute">→ 21:48:09  blocked SYN amplification · 88 Gbps</p>
                                <p class="t-line t-mute">→ 21:48:02  blocked DNS reflection · 31 Gbps</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                (function () {
                    const container = document.querySelector('.scroll-showcase-container');
                    if (!container) return;
                    let ticking = false;
                    function update() {
                        const rect = container.getBoundingClientRect();
                        const total = rect.height - window.innerHeight;
                        const scrolled = -rect.top;
                        const progress = Math.max(0, Math.min(1, total > 0 ? scrolled / total : 0));
                        container.style.setProperty('--scroll-progress', progress.toFixed(4));
                        ticking = false;
                    }
                    function onScroll() {
                        if (!ticking) { window.requestAnimationFrame(update); ticking = true; }
                    }
                    window.addEventListener('scroll', onScroll, { passive: true });
                    window.addEventListener('resize', onScroll, { passive: true });
                    update();
                })();
            </script>
        </section>

        <section class="landing-section reveal-on-scroll" id="vps-section">
            <div class="main-container">
                <div class="section-header">
                    <div class="section-copy">
                        <span class="section-eyebrow">Servidores</span>
                        <h2 class="section-title">VPS y dedicados sin ruido.</h2>
                        <p class="section-description">Planes claros para empezar pequeño, subir rendimiento o trabajar con hardware exclusivo.</p>
                    </div>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Ver catálogo</a>
                </div>

                <div class="services-grid">
                    <a href="{{ route('categories.index') }}?type=vps" class="service-link reveal-child">
                        <article class="service-card">
                            <div>
                                <span class="service-icon-wrapper">
                                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="6" rx="2"/><rect x="3" y="14" width="18" height="6" rx="2"/><path d="M7 7h.01M7 17h.01"/></svg>
                                </span>
                                <h3 class="service-title">VPS económico</h3>
                                <p class="service-description">Para webs pequeñas, bots, pruebas y servicios que necesitan algo sencillo pero estable.</p>
                            </div>
                            <span class="service-action">Ver planes →</span>
                        </article>
                    </a>

                    <a href="{{ route('categories.index') }}?type=vps" class="service-link reveal-child">
                        <article class="service-card featured">
                            <div>
                                <span class="service-icon-wrapper">
                                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M4 13h16M4 17h16M7 9h10M8 3h8l2 6H6l2-6Z"/><path d="M8 21h8"/></svg>
                                </span>
                                <h3 class="service-title">VPS Ryzen</h3>
                                <p class="service-description">Más rendimiento por núcleo para paneles, comunidades, juegos y servicios con carga real.</p>
                            </div>
                            <span class="service-action">Ver planes →</span>
                        </article>
                    </a>

                    <a href="{{ route('categories.index') }}?type=dedicated" class="service-link reveal-child">
                        <article class="service-card">
                            <div>
                                <span class="service-icon-wrapper">
                                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="4" y="3" width="16" height="18" rx="2"/><path d="M8 7h8M8 11h8M8 15h4"/></svg>
                                </span>
                                <h3 class="service-title">Dedicados</h3>
                                <p class="service-description">Hardware exclusivo para cargas pesadas, comunidades grandes y proyectos que necesitan margen.</p>
                            </div>
                            <span class="service-action">Ver planes →</span>
                        </article>
                    </a>
                </div>
            </div>
        </section>

        <section class="dark-band reveal-on-scroll" id="network-section">
            <div class="main-container network-grid">
                <div>
                    <span class="section-eyebrow">Red y Anti-DDoS</span>
                    <h2 class="section-title">Infraestructura estable para proyectos que no pueden ir lentos.</h2>
                    <p class="section-description">
                        Priorizamos red, soporte y operación diaria. Al final, lo importante es que el servicio responda cuando hay usuarios dentro.
                    </p>
                    <ul class="network-list">
                        <li>Mitigación Anti-DDoS en red</li>
                        <li>Puerto 1 Gbps incluido en servicios seleccionados</li>
                        <li>Monitorización operativa y soporte técnico de verdad</li>
                    </ul>
                </div>

                <div class="network-card">
                    <div class="network-row">
                        <span>ASN</span>
                        <strong>AS214340</strong>
                    </div>
                    <div class="network-row">
                        <span>Estado</span>
                        <strong>Operativo</strong>
                    </div>
                    <div class="network-row">
                        <span>Protección</span>
                        <strong>Anti-DDoS</strong>
                    </div>
                    <div class="network-row">
                        <span>Ubicación</span>
                        <strong>España</strong>
                    </div>
                </div>
            </div>
        </section>

        <section class="landing-section reveal-on-scroll ddos-section" id="antiddos-section">
            <div class="main-container">
                <div class="section-header">
                    <div class="section-copy">
                        <span class="section-eyebrow">Anti-DDoS · Mitigación activa</span>
                        <h2 class="section-title">Cuando el ataque llega, ya está filtrado.</h2>
                        <p class="section-description">
                            Mitigamos ataques volumétricos y de capa de aplicación en el borde de red,
                            con tecnología XDP/eBPF y filtrado simétrico. Sin pcaps, sin intervención
                            manual y sin falsos positivos cortando salidas legítimas.
                        </p>
                    </div>
                </div>

                <article class="ddos-panel" data-ddos-panel aria-label="Visualización en tiempo real de mitigación de ataques">
                    <header class="ddos-panel-header">
                        <h3 class="ddos-panel-title">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M12 2 4 6v6c0 5 3.5 8 8 10 4.5-2 8-5 8-10V6l-8-4Z"/>
                                <path d="m9 12 2 2 4-4"/>
                            </svg>
                            <span class="ddos-panel-title-link" data-ddos-attack>UDP flood</span>
                        </h3>

                        <div class="ddos-panel-meta">
                            <span class="ddos-status-pill is-attack" data-ddos-status role="status">
                                <span class="ddos-status-label" data-ddos-status-label>Mitigando ataque</span>
                            </span>
                            <span class="ddos-panel-time">
                                <span class="ddos-live-dot" aria-hidden="true"></span>
                                <span data-ddos-clock>en directo</span>
                                <span class="ddos-panel-tz">UTC+1</span>
                            </span>
                        </div>
                    </header>

                    <div class="ddos-chart-wrap">
                        <ul class="ddos-yaxis" data-ddos-yaxis aria-hidden="true">
                            <li>1 Tbps</li>
                            <li>800 Gbps</li>
                            <li>600 Gbps</li>
                            <li>400 Gbps</li>
                            <li>200 Gbps</li>
                            <li>0 bps</li>
                        </ul>

                        <svg class="ddos-chart" viewBox="0 0 800 340" preserveAspectRatio="none" aria-hidden="true">
                            <defs>
                                <linearGradient id="ddos-area-gradient" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%"  stop-color="#3b82f6" stop-opacity="0.55"/>
                                    <stop offset="60%" stop-color="#3b82f6" stop-opacity="0.18"/>
                                    <stop offset="100%" stop-color="#3b82f6" stop-opacity="0.02"/>
                                </linearGradient>
                            </defs>
                            <g class="ddos-chart-grid">
                                <line x1="0" y1="0"   x2="800" y2="0"/>
                                <line x1="0" y1="68"  x2="800" y2="68"/>
                                <line x1="0" y1="136" x2="800" y2="136"/>
                                <line x1="0" y1="204" x2="800" y2="204"/>
                                <line x1="0" y1="272" x2="800" y2="272"/>
                                <line x1="0" y1="340" x2="800" y2="340" class="is-base"/>

                                <line x1="100"  y1="0" x2="100"  y2="340"/>
                                <line x1="240"  y1="0" x2="240"  y2="340"/>
                                <line x1="380"  y1="0" x2="380"  y2="340"/>
                                <line x1="520"  y1="0" x2="520"  y2="340"/>
                                <line x1="660"  y1="0" x2="660"  y2="340"/>
                                <line x1="800"  y1="0" x2="800"  y2="340"/>
                            </g>

                            <g class="ddos-chart-scroll" data-ddos-scroll>
                                <path class="ddos-chart-area" data-ddos-area
                                      d="M 0 340 L 110 340 L 118 178 L 132 78 L 150 92 L 168 70 L 188 88 L 208 74 L 228 90 L 246 78 L 266 86 L 286 74 L 306 90 L 326 78 L 346 86 L 366 74 L 386 90 L 406 80 L 426 92 L 446 78 L 466 88 L 486 76 L 506 90 L 526 80 L 546 88 L 566 74 L 586 92 L 606 80 L 626 88 L 644 270 L 670 290 L 700 298 L 740 302 L 800 304 L 800 340 Z"/>

                                <path class="ddos-chart-stroke" data-ddos-stroke
                                      d="M 0 340 L 110 340 L 118 178 L 132 78 L 150 92 L 168 70 L 188 88 L 208 74 L 228 90 L 246 78 L 266 86 L 286 74 L 306 90 L 326 78 L 346 86 L 366 74 L 386 90 L 406 80 L 426 92 L 446 78 L 466 88 L 486 76 L 506 90 L 526 80 L 546 88 L 566 74 L 586 92 L 606 80 L 626 88 L 644 270 L 670 290 L 700 298 L 740 302 L 800 304"/>
                            </g>

                            <line class="ddos-chart-now" x1="798" y1="0" x2="798" y2="340"/>
                            <line class="ddos-crosshair" data-ddos-crosshair x1="0" y1="0" x2="0" y2="340"/>
                        </svg>

                        <ul class="ddos-xaxis" data-ddos-xaxis aria-hidden="true">
                            <li>−40s</li><li>−30s</li><li>−20s</li><li>−10s</li><li>now</li>
                        </ul>

                        <div class="ddos-tooltip" data-ddos-tooltip role="img" aria-label="Pico de ataque en tiempo real">
                            <p class="ddos-tooltip-time" data-ddos-tt-time>—</p>
                            <p class="ddos-tooltip-metric">
                                <span class="ddos-tooltip-dot"></span>
                                B: <strong data-ddos-tt-b>—</strong>
                            </p>
                            <p class="ddos-tooltip-metric">
                                <span class="ddos-tooltip-dot"></span>
                                P: <strong data-ddos-tt-p>—</strong>
                            </p>
                        </div>
                    </div>
                </article>

                <div class="features-grid ddos-features">
                    <article class="feature-card reveal-child">
                        <span class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="m12 2 9 5v6c0 5-3.5 9-9 10-5.5-1-9-5-9-10V7l9-5Z"/>
                                <path d="m8 12 3 3 5-6"/>
                            </svg>
                        </span>
                        <h3 class="feature-title">XDP / eBPF en kernel</h3>
                        <p class="feature-desc">Filtrado a línea de cable directamente en el kernel. Throughput alto sin penalizar la máquina y sin recursos malgastados.</p>
                        <span class="ddos-tag">Línea de cable</span>
                    </article>

                    <article class="feature-card reveal-child">
                        <span class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M3 12h7M14 12h7"/>
                                <path d="m6 9 3 3-3 3M18 9l-3 3 3 3"/>
                            </svg>
                        </span>
                        <h3 class="feature-title">Filtrado simétrico</h3>
                        <p class="feature-desc">Mismo perfil de tráfico entrante y saliente. Falsos positivos casi a cero y conexiones legítimas intactas durante el ataque.</p>
                        <span class="ddos-tag">Sin falsos positivos</span>
                    </article>

                    <article class="feature-card reveal-child">
                        <span class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="12" cy="12" r="9"/>
                                <path d="M12 7v5l3 2"/>
                            </svg>
                        </span>
                        <h3 class="feature-title">Mitigación permanente</h3>
                        <p class="feature-desc">Defensa activa 24/7. Bloqueo desde el primer paquete malicioso, sin tiempos de aprendizaje ni ventanas en las que entras vulnerable.</p>
                        <span class="ddos-tag">Always-on</span>
                    </article>

                    <article class="feature-card reveal-child">
                        <span class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M3 6h18M3 12h18M3 18h18"/>
                                <circle cx="7" cy="6" r="1.5" fill="currentColor"/>
                                <circle cx="13" cy="12" r="1.5" fill="currentColor"/>
                                <circle cx="17" cy="18" r="1.5" fill="currentColor"/>
                            </svg>
                        </span>
                        <h3 class="feature-title">Cobertura L3 · L4 · L7</h3>
                        <p class="feature-desc">Volumétrico, TCP/UDP, juego y aplicación. Cobertura desde la red hasta la capa de aplicación, con perfiles específicos por tipo de servicio.</p>
                        <span class="ddos-tag">Multi-capa</span>
                    </article>

                    <article class="feature-card reveal-child">
                        <span class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="11" cy="11" r="7"/>
                                <path d="m20 20-3.5-3.5"/>
                                <path d="M11 8v6M8 11h6"/>
                            </svg>
                        </span>
                        <h3 class="feature-title">Diagnóstico con sFlow</h3>
                        <p class="feature-desc">Análisis sobre el tráfico que cruza nuestra red. Ajustes finos al instante, sin pedirte pcaps ni capturas desde el servidor afectado.</p>
                        <span class="ddos-tag">Sin pcaps</span>
                    </article>

                    <article class="feature-card reveal-child">
                        <span class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M12 3 3 7v5c0 5 4 8 9 10 5-2 9-5 9-10V7l-9-4Z"/>
                                <path d="M9 11h6M12 8v6"/>
                            </svg>
                        </span>
                        <h3 class="feature-title">Filtros a medida</h3>
                        <p class="feature-desc">Reglas personalizadas para tu servicio cuando un perfil estándar no encaja. Adaptamos la defensa al ataque, no al revés.</p>
                        <span class="ddos-tag">Custom rules</span>
                    </article>
                </div>
            </div>
        </section>

        <section class="landing-section reveal-on-scroll" id="game-section">
            <div class="main-container">
                <div class="section-header">
                    <div class="section-copy">
                        <span class="section-eyebrow">Game hosting</span>
                        <h2 class="section-title">Servidores de juego preparados para comunidades.</h2>
                        <p class="section-description">FiveM y Minecraft con recursos claros, red estable y soporte cuando necesitas revisar algo rápido.</p>
                    </div>
                </div>

                <div class="services-grid">
                    <a href="{{ route('categories.index') }}?type=game" class="service-link reveal-child">
                        <article class="service-card featured">
                            <div>
                                <span class="service-icon-wrapper">
                                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="7" width="18" height="10" rx="3"/><path d="M8 12h4M10 10v4M17 11h.01M19 13h.01"/></svg>
                                </span>
                                <h3 class="service-title">FiveM Hosting</h3>
                                <p class="service-description">Para comunidades de roleplay que necesitan buen rendimiento por núcleo y soporte cercano.</p>
                            </div>
                            <span class="service-action">Ver planes →</span>
                        </article>
                    </a>

                    <a href="{{ route('categories.index') }}?type=game" class="service-link reveal-child">
                        <article class="service-card">
                            <div>
                                <span class="service-icon-wrapper">
                                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="m21 16-9 5-9-5V8l9-5 9 5v8Z"/><path d="m3.3 7.3 8.7 5 8.7-5M12 22V12"/></svg>
                                </span>
                                <h3 class="service-title">Minecraft Hosting</h3>
                                <p class="service-description">Servidores para survival, networks y proyectos con plugins que necesitan margen.</p>
                            </div>
                            <span class="service-action">Ver planes →</span>
                        </article>
                    </a>

                    <a href="{{ route('categories.index') }}" class="service-link reveal-child">
                        <article class="service-card">
                            <div>
                                <span class="service-icon-wrapper">
                                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 0 20M12 2a15.3 15.3 0 0 0 0 20"/></svg>
                                </span>
                                <h3 class="service-title">Web hosting</h3>
                                <p class="service-description">Alojamiento para webs y proyectos que necesitan una base simple, estable y mantenible.</p>
                            </div>
                            <span class="service-action">Ver planes →</span>
                        </article>
                    </a>
                </div>
            </div>
        </section>

        @php
            $testimonials = [
                [
                    'name' => 'Daniel R.',
                    'role' => 'Comunidad FiveM',
                    'rating' => 5,
                    'quote' => 'Llevamos seis meses con un VPS Ryzen y el rendimiento para roleplay es brutal. Cuando hemos tenido dudas, el soporte en Discord nos contesta en minutos.',
                ],
                [
                    'name' => 'Marcos G.',
                    'role' => 'Webmaster',
                    'rating' => 5,
                    'quote' => 'Migré desde otro hosting tras un ataque DDoS que me tumbó la web tres días. Aquí la mitigación va siempre activa y ni me he enterado.',
                ],
                [
                    'name' => 'Lucía P.',
                    'role' => 'Agencia digital · ES',
                    'rating' => 5,
                    'quote' => 'Tres proyectos alojados, sin caídas. Cuando pregunto algo me responde una persona, no un bot, y eso ya no se ve en muchos sitios.',
                ],
                [
                    'name' => 'Iván L.',
                    'role' => 'Servidor Minecraft · MX',
                    'rating' => 5,
                    'quote' => 'Servidor Minecraft con 80 jugadores estables sin lag. La red española me da buena latencia incluso desde LATAM.',
                ],
                [
                    'name' => 'Sergio H.',
                    'role' => 'Bot de Discord',
                    'rating' => 5,
                    'quote' => 'Activación del VPS en cinco minutos. Panel claro, sin enredos. Para bot y dashboard me sobra y funciona perfecto 24/7.',
                ],
                [
                    'name' => 'Ana M.',
                    'role' => 'eCommerce',
                    'rating' => 5,
                    'quote' => 'Migré la tienda WooCommerce desde un compartido. Mejor TTFB, sin caídas y un soporte técnico cercano que se moja cuando hay que ayudar.',
                ],
                [
                    'name' => 'Pablo C.',
                    'role' => 'Desarrollador',
                    'rating' => 5,
                    'quote' => 'VPS para staging con acceso root, snapshots y red estable. Lo que esperaba pagando bastante más en otros proveedores.',
                ],
                [
                    'name' => 'Carlos V.',
                    'role' => 'Comunidad FiveM',
                    'rating' => 5,
                    'quote' => 'Pasamos de 32 a 96 slots y el servidor sigue suave. Fueron honestos con lo que necesitábamos, no nos vendieron de más.',
                ],
                [
                    'name' => 'Marta J.',
                    'role' => 'Hosting reseller',
                    'rating' => 5,
                    'quote' => 'Dedicado con 20 servicios de clientes encima. Anti-DDoS de fábrica y un soporte que entiende lo que le cuentas a la primera.',
                ],
                [
                    'name' => 'Roberto F.',
                    'role' => 'Roleplay GTA · 200+ slots',
                    'rating' => 5,
                    'quote' => 'La protección DDoS aguantó dos ataques serios sin downtime. Para una comunidad de 200 jugadores eso vale oro.',
                ],
                [
                    'name' => 'David T.',
                    'role' => 'Bot Discord (miles de servers)',
                    'rating' => 5,
                    'quote' => 'Bot con miles de servidores corriendo sin problemas. Uptime real y precio honesto. No tengo nada que reprochar.',
                ],
                [
                    'name' => 'Elena S.',
                    'role' => 'Web personal + CMS',
                    'rating' => 5,
                    'quote' => 'Probé barato y me arrepentí. Aquí no he tenido sustos en todo el año. Recomendado para quien quiera dormir tranquilo.',
                ],
            ];

            $palette = ['#3b82f6', '#1d4ed8', '#0ea5e9', '#6366f1'];
            $cols = [
                array_slice($testimonials, 0, 4),
                array_slice($testimonials, 4, 4),
                array_slice($testimonials, 8, 4),
            ];
        @endphp

        <section class="landing-section testimonials-section reveal-on-scroll" id="testimonials-section">
            <div class="main-container">
                <div class="testimonials-header">
                    <span class="section-eyebrow">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" width="12" height="12">
                            <path d="m12 2 3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77 5.82 21l1.18-6.88-5-4.87 6.91-1.01L12 2Z"/>
                        </svg>
                        Reseñas verificadas en Trustpilot
                    </span>
                    <h2 class="section-title">Lo que cuentan quienes ya están dentro.</h2>
                    <p class="section-description">
                        Comunidades, agencias, desarrolladores y proyectos que llevan tiempo operando sobre nuestra red.
                        Estas son sus palabras, no las nuestras.
                    </p>
                </div>

                <div class="testimonials-grid" aria-label="Testimonios de clientes">
                    @foreach($cols as $i => $col)
                        <div class="testimonials-column testimonials-column-{{ $i }}">
                            <div class="testimonials-track">
                                @for($pass = 0; $pass < 2; $pass++)
                                    @foreach($col as $j => $t)
                                        @php $color = $palette[($i * 4 + $j) % count($palette)]; @endphp
                                        <article class="testimonial-card" @if($pass === 1) aria-hidden="true" @endif>
                                            <div class="testimonial-stars" aria-label="{{ $t['rating'] }} de 5 estrellas">
                                                @for($s = 0; $s < 5; $s++)
                                                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                        <path d="m12 2 3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77 5.82 21l1.18-6.88-5-4.87 6.91-1.01L12 2Z"/>
                                                    </svg>
                                                @endfor
                                            </div>
                                            <p class="testimonial-quote">{{ $t['quote'] }}</p>
                                            <div class="testimonial-author">
                                                <span class="testimonial-avatar" style="background: {{ $color }};">{{ mb_substr($t['name'], 0, 1) }}</span>
                                                <div class="testimonial-meta">
                                                    <span class="testimonial-name">{{ $t['name'] }}</span>
                                                    <span class="testimonial-role">{{ $t['role'] }}</span>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                @endfor
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="testimonials-footer">
                    <a href="https://www.trustpilot.com/review/24racks.com" target="_blank" rel="noopener noreferrer" class="btn btn-secondary">
                        Ver todas las reseñas en Trustpilot
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M7 17 17 7M9 7h8v8"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>
    </main>

    @include('theme::layouts.footer')
</body>
</html>
