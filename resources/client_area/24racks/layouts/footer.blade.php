<footer class="footer-shell landing-footer reveal-on-scroll">
    <div class="footer-inner">
        <div class="footer-grid">
            <div class="footer-company">
                <a href="/" class="footer-brand" wire:navigate aria-label="{{ __('messages.go_to_home') }}">
                    <img src="{{ settings('app_logo', '/assets/common/img/app-logo.png') }}" alt="{{ settings('app_name', '24racks Cloud') }} logo">
                </a>

                <h2 class="footer-company-name">24racks Cloud S.L.</h2>
                <p class="footer-copy">
                    {{ __('messages.company_short_description') }}
                </p>

                <ul class="footer-contact-list">
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.32 1.77.59 2.61a2 2 0 0 1-.45 2.11L8 9.69a16 16 0 0 0 6.31 6.31l1.25-1.25a2 2 0 0 1 2.11-.45c.84.27 1.71.47 2.61.59A2 2 0 0 1 22 16.92Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <a href="tel:+34608318160">+34 608 31 81 60</a>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M20.5 11.8a8.5 8.5 0 0 1-12.6 7.45L3 20.5l1.3-4.75A8.5 8.5 0 1 1 20.5 11.8Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M8.7 8.65c.18-.42.36-.44.66-.44h.5c.16 0 .4.06.6.32.22.26.82 1 .82 2.42 0 .2-.07.38-.2.52l-.43.5c-.14.16-.1.34.03.54.37.67 1.04 1.45 1.78 1.9.23.14.4.16.56-.02l.6-.7c.18-.22.38-.18.64-.1.26.1 1.66.78 1.94.92.28.14.46.2.53.32.07.12.07.72-.17 1.4-.24.68-1.38 1.3-1.92 1.34-.5.04-1.14.06-1.84-.12-.42-.1-.96-.3-1.66-.6-2.92-1.26-4.82-4.2-4.96-4.4-.14-.2-1.18-1.58-1.18-3.02 0-1.44.74-2.14 1-2.42Z" fill="currentColor"/></svg>
                        <a href="https://wa.me/34608318160" target="_blank" rel="noopener noreferrer">{{ __('messages.whatsapp') }}</a>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 6h16v12H4V6Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <a href="mailto:asistencia@24racks.com">asistencia@24racks.com</a>
                    </li>
                </ul>

                <div class="footer-legal">
                    <p>NIF B26771048</p>
                    <p>Durango, Bizkaia (España)</p>
                    <p>Registro Mercantil de Bizkaia</p>
                    <p>Network ASN: AS214340</p>
                </div>
            </div>

            <div>
                <h5 class="footer-title">{{ __('messages.services') }}</h5>
                <ul class="footer-list">
                    <li><a href="/#vps-section">{{ __('messages.vps_xeon') }}</a></li>
                    <li><a href="/#vps-section">{{ __('messages.vps_ryzen') }}</a></li>
                    <li><a href="/#vps-section">{{ __('messages.vps_economic') }}</a></li>
                    <li><a href="/#vps-section">{{ __('messages.dedicated') }}</a></li>
                    <li><a href="/#game-section">FiveM</a></li>
                    <li><a href="/#game-section">Minecraft</a></li>
                </ul>
            </div>

            <div>
                <h5 class="footer-title">{{ __('messages.links') }}</h5>
                <ul class="footer-list">
                    <li><a href="{{ route('dashboard') }}">{{ __('messages.client_area') }}</a></li>
                    <li class="is-online"><a href="/#network-section">{{ __('messages.service_status') }}</a></li>
                    <li><a href="{{ route('categories.index') }}?type=game">{{ __('messages.game_panel') }}</a></li>
                    <li><a href="{{ route('categories.index') }}?type=vps">{{ __('messages.vps_panel') }}</a></li>
                </ul>
            </div>

            <div>
                <h5 class="footer-title">{{ __('messages.support') }}</h5>
                <ul class="footer-list">
                    <li><a href="/p/terms" wire:navigate>{{ __('messages.terms_of_service') }}</a></li>
                    <li><a href="/p/privacy" wire:navigate>{{ __('messages.privacy_policy') }}</a></li>
                    <li><a href="/p/cookies" wire:navigate>{{ __('messages.cookies_policy') }}</a></li>
                    <li class="is-danger"><a href="mailto:abuse@24racks.com">{{ __('messages.abuse_report') }}</a></li>
                    <li><a href="/p/accessibility" wire:navigate>{{ __('messages.accessibility') }}</a></li>
                    @foreach(extensionElements(['footer-item']) as $element)
                        <li>
                            <a href="{{ $element['attributes']['href'] ?? '#' }}" wire:navigate>
                                {{ $element['attributes']['name'] ?? 'undefined' }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <span>Copyright © {{ now()->year }} 24racks Cloud S.L. {{ __('messages.all_rights_reserved') }}</span>

            <div class="footer-bottom-actions">
                <div class="footer-socials" aria-label="{{ __('messages.social_networks') }}">
                    <a href="https://discord.gg/njjhDfYW6m" target="_blank" rel="noopener noreferrer" aria-label="Discord">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.3 4.4A16.9 16.9 0 0 0 16.1 3l-.2.4c1.5.4 2.2 1 2.2 1a13.7 13.7 0 0 0-12.2 0s.8-.6 2.3-1L8 3a16.9 16.9 0 0 0-4.3 1.4C1 8.4.3 12.3.6 16.1A17.1 17.1 0 0 0 5.8 19s.6-.8 1-1.5a6.4 6.4 0 0 1-1.7-.8l.4-.3a12.2 12.2 0 0 0 13 0l.4.3c-.5.3-1.1.6-1.7.8.4.7 1 1.5 1 1.5a17.1 17.1 0 0 0 5.2-2.9c.4-4.4-.7-8.2-3.1-11.7ZM8.4 14.2c-1 0-1.8-.9-1.8-2s.8-2 1.8-2 1.8.9 1.8 2-.8 2-1.8 2Zm7.2 0c-1 0-1.8-.9-1.8-2s.8-2 1.8-2 1.8.9 1.8 2-.8 2-1.8 2Z"/></svg>
                    </a>
                    <a href="https://wa.me/34608318160" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12.1 2a9.8 9.8 0 0 0-8.4 14.8L2.5 22l5.3-1.2A9.8 9.8 0 1 0 12.1 2Zm0 17.7c-1.5 0-2.9-.4-4.1-1.1l-.3-.2-3.1.7.7-3-.2-.3a7.9 7.9 0 1 1 7 3.9Zm4.5-5.9c-.2-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1l-.8 1c-.1.2-.3.2-.5.1a6.5 6.5 0 0 1-3.2-2.8c-.1-.2 0-.4.1-.5l.4-.5c.1-.1.1-.3.2-.4v-.4c-.1-.1-.6-1.4-.8-1.9-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.2.2-.9.9-.9 2.2s.9 2.5 1 2.7c.1.2 1.8 2.9 4.5 4 .6.3 1.1.4 1.5.5.6.2 1.1.1 1.5.1.5-.1 1.5-.6 1.7-1.2.2-.6.2-1.1.1-1.2-.1-.2-.3-.3-.7-.5Z"/></svg>
                    </a>
                    <a href="https://www.linkedin.com/company/24racks" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.9 8.8H3.6V20h3.3V8.8ZM5.3 3.5a1.9 1.9 0 1 0 0 3.8 1.9 1.9 0 0 0 0-3.8ZM20.4 13.8c0-3-1.6-5.2-4.3-5.2-1.6 0-2.6.9-3 1.7h-.1V8.8H9.8V20h3.3v-5.5c0-1.5.3-2.9 2.1-2.9 1.7 0 1.8 1.6 1.8 3V20h3.3v-6.2Z"/></svg>
                    </a>
                    <a href="https://www.trustpilot.com/review/24racks.com" target="_blank" rel="noopener noreferrer" aria-label="Trustpilot">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="m12 2 2.8 6.7 7.2.6-5.5 4.7 1.7 7-6.2-3.7L5.8 21l1.7-7L2 9.3l7.2-.6L12 2Z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
