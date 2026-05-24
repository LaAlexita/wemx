<?php

use Livewire\Volt\Component;
use App\Models\User;

new class extends Component
{
    public $current_password;

    public $new_email;

    public $tfa_code;

    public function updateEmail()
    {
        $this->resetErrorBag();

        User::actions()->updateEmailAddressAsClient([
            'user_id' => auth()->id(),
            'current_password' => $this->current_password,
            'new_email' => $this->new_email,
            'tfa_code' => $this->tfa_code,
        ]);

        $this->dispatch('toast', type: 'success', message: __('messages.email_updated_toast'), title: __('messages.success'));
        $this->reset(['current_password', 'new_email']);
    }
}
?>


<x-theme::card class="mb-4">
    <div class="mb-4">
        <x-theme::text.h5 :text="__('messages.update_email_address')" class="mb-2" />
        <x-theme::text.p :text="__('messages.update_email_address_desc')" />
    </div>
    <form wire:submit="updateEmail()" autocomplete="off">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6">
                <x-theme::form.label for="current-password" :text="__('messages.current_password')" class="mb-2" />
                <x-theme::form.input type="password" wire:model="current_password" name="current_password" id="current-password" placeholder="••••••••" class="block w-full" />
                @error('current_password')
                    <x-theme::form.error :text="$message"/>
                @enderror
            </div>
            <div class="col-span-6">
                <x-theme::form.label for="new_email" :text="__('messages.new_email_address')" class="mb-2" />
                <x-theme::form.input type="email" name="new_email" id="new_email" wire:model="new_email" :placeholder="__('messages.new_email_address')" class="block w-full" />
                @error('new_email')
                    <x-theme::form.error :text="$message"/>
                @enderror
            </div>
            @if(auth()->user()->tfa_enabled)
                <div class="col-span-6">
                    <x-theme::form.label for="tfa_code" :text="__('messages.two_fa_code')" class="mb-2" />
                    <x-theme::form.input type="text" name="tfa_code" id="tfa_code" wire:model="tfa_code" :placeholder="__('messages.two_fa_code')" class="block w-full" />
                    @error('tfa_code')
                        <x-theme::form.error :text="$message"/>
                    @enderror
                </div>
            @endif
            <div class="col-span-6">
                <x-theme::button.primary class="col-span-6" type="submit" :text="__('messages.update_email_address')" />
            </div>
        </div>
    </form>
</x-theme::card>
