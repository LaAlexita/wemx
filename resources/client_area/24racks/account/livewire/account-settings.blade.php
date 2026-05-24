<?php

use Livewire\Volt\Component;

new class extends Component
{
};
?>

<div class="account-settings-grid">
    <aside class="account-settings-sidebar">
        <section class="rack-card account-profile-card">
            <div class="account-profile-main">
                @if (auth()->user()->avatar !== null)
                    <img class="account-avatar" src="{{ auth()->user()->getAvatarUrl() }}" alt="{{ auth()->user()->full_name }}">
                @else
                    <div class="account-avatar account-avatar-fallback">
                        {{ substr(auth()->user()->first_name, 0, 1) . substr(auth()->user()->last_name, 0, 1) }}
                    </div>
                @endif

                <div>
                    <h2 class="account-profile-name">{{ auth()->user()->full_name }}</h2>
                    <p class="account-profile-meta">{{ __('messages.member_since', ['date' => auth()->user()->created_at->locale(app()->getLocale())->isoFormat('MMMM YYYY')]) }}</p>
                </div>
            </div>

            @if(settings('allow_custom_avatars', false))
                <form action="#" method="POST" enctype="multipart/form-data" class="account-upload-form">
                    @csrf
                    <label for="dropzone-file" class="account-upload-box">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" style="color: var(--text-3); margin-bottom: 4px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"/>
                        </svg>
                        <span>{{ __('messages.drag_image_or_select') }}</span>
                        <small>{{ __('messages.upload_image_specs') }}</small>
                        <input id="dropzone-file" type="file" name="avatar" accept="image/*" required class="hidden">
                    </label>
                    <button type="submit" class="btn btn-primary btn-sm">{{ __('messages.upload_avatar') }}</button>
                </form>
            @endif
        </section>

        <section class="rack-card account-side-card">
            <h3>{{ __('messages.two_factor_auth') }}</h3>
            <p>{{ __('messages.two_factor_auth_desc') }}</p>

            <div class="account-side-action">
                @if (!auth()->user()->tfa_enabled)
                    <a href="{{ route('enable-2fa') }}" wire:navigate class="btn btn-primary">{{ __('messages.enable_2fa') }}</a>
                @else
                    <a href="{{ route('disable-2fa') }}" wire:navigate class="btn btn-danger">{{ __('messages.disable_2fa') }}</a>
                @endif
            </div>
        </section>

        @livewire(client_view_path('account.livewire.view-sessions'))
    </aside>

    <section class="account-settings-main">
        @livewire(client_view_path('account.livewire.general-settings'))
        @livewire(client_view_path('account.livewire.update-address'))
        @livewire(client_view_path('account.livewire.update-email'))
        @livewire(client_view_path('account.livewire.update-password'))
    </section>
</div>
