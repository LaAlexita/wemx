<?php

use App\Models\Session;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Volt\Component;

new class extends Component
{
    #[Computed]
    public function sessions()
    {
        return Session::where('user_id', auth()->id())->latest('last_activity')->paginate(6);
    }

    public function logSessionOut($sessionId)
    {
        $status = User::actions()->logoutSessionAsClient([
            'user_id' => auth()->id(),
            'session_id' => $sessionId,
        ]);

        if ($status) {
            $this->dispatch('toast', type: 'success', message: __('messages.session_closed_success'), title: __('messages.done'));
        } else {
            $this->dispatch('toast', type: 'error', message: __('messages.session_not_found'), title: __('messages.error'));
        }
    }
};
?>

<section class="rack-card account-sessions-card">
    <h3>{{ __('messages.active_sessions') }}</h3>
    <p style="color: var(--text-2); font-size: 13px; margin: 6px 0 0;">{{ __('messages.active_sessions_desc') }}</p>

    <ul class="account-session-list">
        @foreach($this->sessions() as $session)
            <li class="account-session-item">
                <div class="account-session-icon">
                    @if($session->isDesktopDevice())
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2z"/>
                        </svg>
                    @else
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2z"/>
                        </svg>
                    @endif
                </div>

                <div class="account-session-body">
                    <p>{{ $session->operatingSystem() }} <span style="font-weight: 500; color: var(--text-3);">({{ $session->browser() }})</span></p>
                    <span><span class="font-mono">{{ $session->ip_address }}</span> · {{ __('messages.last_activity') }} {{ $session->last_activity->diffForHumans() }}</span>
                </div>

                <button wire:click="logSessionOut('{{ $session->id }}')" wire:confirm="{{ __('messages.confirm_close_session') }}" class="btn btn-secondary btn-sm">
                    {{ __('messages.close_session') }}
                </button>
            </li>
        @endforeach
    </ul>

    <div class="account-pagination">
        {{ $this->sessions()->links() }}
    </div>
</section>
