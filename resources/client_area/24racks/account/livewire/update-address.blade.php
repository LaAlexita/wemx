<?php

use Livewire\Volt\Component;
use App\Models\User;

new class extends Component
{
    public $company_name;

    public $tax_id;

    public $address;

    public $address2;

    public $country;

    public $region;

    public $city;

    public $zip_code;

    public function mount(): void
    {
        $address = auth()->user()->address;
        $this->company_name = $address->company_name;
        $this->tax_id = $address->tax_id;
        $this->address = $address->address;
        $this->address2 = $address->address2;
        $this->country = $address->country;
        $this->region = $address->region;
        $this->city = $address->city;
        $this->zip_code = $address->zip_code;
    }

    public function updateAddress()
    {
        $this->resetErrorBag();

        User::actions()->updateAddressAsClient([
            'user_id' => auth()->id(),
            'company_name' => $this->company_name,
            'tax_id' => $this->tax_id,
            'address' => $this->address,
            'address2' => $this->address2,
            'country' => $this->country,
            'region' => $this->region,
            'city' => $this->city,
            'zip_code' => $this->zip_code,
        ]);

        $this->dispatch('toast', type: 'success', message: __('messages.address_saved'), title: __('messages.success'));
    }
}
?>


<x-theme::card class="mb-4">
    <div class="mb-4">
        <x-theme::text.h5 :text="__('messages.my_address')" class="mb-2" />
        <x-theme::text.p :text="__('messages.my_address_desc')" />
    </div>

    <form wire:submit="updateAddress()">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6">
                <x-theme::form.label for="company_name" :text="__('messages.company_name')" class="mb-2" />
                <x-theme::form.input type="text" wire:model.change="company_name" name="company_name" id="company_name" :placeholder="__('messages.company_name')" class="block w-full" />
                @error('company_name')
                <x-theme::form.error :text="$message"/>
                @enderror
            </div>
            @if($company_name)
                <div class="col-span-6">
                    <x-theme::form.label for="tax_id" :text="__('messages.tax_id')" class="mb-2" />
                    <x-theme::form.input type="text" wire:model="tax_id" name="tax_id" id="tax_id" :placeholder="__('messages.tax_id')" class="block w-full" />
                    @error('tax_id')
                        <x-theme::form.error :text="$message"/>
                    @enderror
                </div>
            @endif
            <div class="col-span-6">
                <x-theme::form.label for="address" :text="__('messages.address')" class="mb-2" />
                <x-theme::form.input type="text" wire:model="address" name="address" id="address" :placeholder="__('messages.address')" class="block w-full" />
                @error('address')
                <x-theme::form.error :text="$message"/>
                @enderror
            </div>
            <div class="col-span-6">
                <x-theme::form.label for="address2" :text="__('messages.address_2')" class="mb-2" />
                <x-theme::form.input type="text" wire:model="address2" name="address2" id="address2" :placeholder="__('messages.address_2')" class="block w-full" />
                @error('address2')
                    <x-theme::form.error :text="$message"/>
                @enderror
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-theme::form.label for="country" :text="__('messages.country')" class="mb-2" />
                <x-theme::form.select wire:model.change="country" name="country" id="country" required :placeholder="__('messages.country')" class="block w-full" :options="\App\Facades\World::countries()" />
                @error('country')
                    <x-theme::form.error :text="$message"/>
                @enderror
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-theme::form.label for="region" :text="__('messages.state_province')" />
                @if(in_array($country, ['US', 'CA']))
                    <x-theme::form.select id="region" wire:model.change="region" :options="\App\Facades\World::states($country)" />
                @else
                    <x-theme::form.input type="text" wire:model="region" name="region" id="region" :placeholder="__('messages.state_province')" class="block w-full" />
                @endif
                @error('region')
                    <x-theme::form.error :text="$message" />
                @enderror
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-theme::form.label for="city" :text="__('messages.city')" class="mb-2" />
                <x-theme::form.input type="text" wire:model="city" name="city" id="city" :placeholder="__('messages.city')" class="block w-full" />
                @error('city')
                    <x-theme::form.error :text="$message"/>
                @enderror
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-theme::form.label for="zip_code" :text="__('messages.zip_code')" class="mb-2" />
                <x-theme::form.input type="text" wire:model="zip_code" name="zip_code" id="zip_code" :placeholder="__('messages.zip_code')" class="block w-full" />
                @error('zip_code')
                    <x-theme::form.error :text="$message"/>
                @enderror
            </div>
            <div class="col-span-6">
                <x-theme::button.primary class="col-span-6" :text="__('messages.save_changes')" />
            </div>
        </div>
    </form>
</x-theme::card>
