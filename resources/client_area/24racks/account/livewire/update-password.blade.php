<?php

use Livewire\Volt\Component;
use App\Models\User;

new class extends Component
{
    public $current_password;

    public $new_password;

    public $new_password_confirmation;

    public $tfa_code;

    public function updatePassword()
    {
        $this->resetErrorBag();

        User::actions()->updatePasswordAsClient([
            'user_id' => auth()->id(),
            'current_password' => $this->current_password,
            'new_password' => $this->new_password,
            'new_password_confirmation' => $this->new_password_confirmation,
            'tfa_code' => $this->tfa_code,
        ]);

        $this->dispatch('toast', type: 'success', message: __('messages.password_updated_toast'), title: __('messages.success'));
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
    }
}
?>


<x-theme::card class="mb-4">
    <div class="mb-4">
        <x-theme::text.h5 :text="__('messages.update_password')" class="mb-2" />
        <x-theme::text.p :text="__('messages.update_password_desc')" />
    </div>
    <form wire:submit="updatePassword()" autocomplete="off">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-3">
                <x-theme::form.label for="current-password" :text="__('messages.current_password')" class="mb-2" />
                <x-theme::form.input type="password" wire:model="current_password" name="current_password" id="current-password" placeholder="••••••••" required class="block w-full" />
                @error('current_password')
                    <x-theme::form.error :text="$message"/>
                @enderror
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-theme::form.label for="new-password" :text="__('messages.new_password')" class="mb-2" />
                <x-theme::form.input type="password" wire:model="new_password" name="new_password" id="new-password" placeholder="••••••••" required class="block w-full" />
                @error('new_password')
                    <x-theme::form.error :text="$message"/>
                @enderror
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-theme::form.label for="new-password-confirmation" :text="__('messages.confirm_new_password')" class="mb-2" />
                <x-theme::form.input type="password" wire:model="new_password_confirmation" name="new_password_confirmation" id="new-password-confirmation" placeholder="••••••••" required class="block w-full" />
                @error('new_password_confirmation')
                    <x-theme::form.error :text="$message"/>
                @enderror
            </div>
            @if(auth()->user()->tfa_enabled)
                <div class="col-span-6 sm:col-span-3">
                    <x-theme::form.label for="tfa_code" :text="__('messages.two_fa_code')" class="mb-2" />
                    <x-theme::form.input type="text" name="tfa_code" id="tfa_code" wire:model="tfa_code" :placeholder="__('messages.two_fa_code')" class="block w-full" />
                    @error('tfa_code')
                        <x-theme::form.error :text="$message"/>
                    @enderror
                </div>
            @endif
            <div class="col-span-6">
                <x-theme::button.primary class="col-span-6" type="submit" :text="__('messages.update_password')" />
            </div>
        </div>
    </form>
</x-theme::card>
