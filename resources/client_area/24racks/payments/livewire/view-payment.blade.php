<?php

use App\Models\Payment;
use Livewire\Volt\Component;
use App\Models\GatewayConfig;
use App\Handlers\BalanceTopupHandler;
use Livewire\Attributes\Computed;

new class extends Component {
    public $payment;
    public $gatewayId = '';
    public $company_name = '';
    public $tax_id = '';
    public $country = '';
    public $region = '';
    public $zip_code = '';

    public function mount(Payment $payment): void
    {
        $this->payment = $payment;

        $gatewayQuery = GatewayConfig::query()
            ->where('type', 'payment')
            ->where('is_active', true);

        if ($payment->handler === BalanceTopupHandler::class) {
            $gatewayQuery->where('extension_identifier', '!=', 'gateway-balance');
        }

        $this->gatewayId = $payment->gateway_config_id ?? $gatewayQuery->first()?->id ?? '';

        if (auth()->user()) {
            $lastPaymentWithTax = auth()->user()->payments()->whereHas('taxDetails')->latest()->first();

            if ($lastPaymentWithTax) {
                $this->company_name = $lastPaymentWithTax->taxDetails['company_name'] ?? '';
                $this->tax_id = $lastPaymentWithTax->taxDetails['tax_id'] ?? '';
                $this->region = $lastPaymentWithTax->taxDetails['region'] ?? '';
                $this->zip_code = $lastPaymentWithTax->taxDetails['zip_code'] ?? '';
                $this->country = $lastPaymentWithTax->taxDetails['country'] ?? '';
            } else {
                $this->company_name = auth()->user()->address->company_name ?? '';
                $this->tax_id = auth()->user()->address->tax_id ?? '';
                $this->region = auth()->user()->address->region ?? '';
                $this->zip_code = auth()->user()->address->zip_code ?? '';
                $this->country = auth()->user()->address->country ?? '';
            }
        }
    }

    #[Computed]
    public function salesTaxTotal(): array
    {
        return \App\Facades\Tax::calculateSalesTax(
            $this->payment->subtotal,
            $this->country,
            $this->region,
            $this->tax_id,
            $this->gatewayId
        );
    }

    public function payPayment(): void
    {
        $payment = Payment::actions()->calculateSalesTaxAsClient([
            'payment_id' => $this->payment->id,
            'gateway_config_id' => $this->gatewayId,
            'company_name' => $this->company_name,
            'tax_id' => $this->tax_id,
            'country' => $this->country,
            'region' => $this->region,
            'zip_code' => $this->zip_code,
        ]);

        $this->redirect(route('payments.pay', [
            'payment' => $payment->token,
            'gateway' => $this->gatewayId,
        ]));
    }
}

?>

<section class="payment-view">
    <div class="page-header">
        <div class="page-header-text">
            <p class="page-header-eyebrow">{{ __('messages.billing') }}</p>
            <h1 class="page-header-title">{{ $payment->isPaid() ? __('messages.invoice_and_payment') : __('messages.pending_payment') }}</h1>
            <p class="page-header-subtitle">{{ $payment->description }}</p>
            <div class="page-header-meta">
                <span>ID #{{ $payment->id }}</span>
                <span>{{ $payment->created_at->format('d M Y H:i') }}</span>
                @if($payment->isPaid())
                    <span class="status-badge status-badge--online">{{ __('messages.paid') }}</span>
                @else
                    <span class="status-badge status-badge--warning">{{ __('messages.pending') }}</span>
                @endif
            </div>
        </div>

        <div class="page-header-actions">
            @if(settings('allow_client_pdf_invoices', false))
                <a href="{{ route('payments.view.invoice-pdf', ['payment' => $payment->token]) }}" class="btn btn-secondary btn-sm">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>
                    {{ __('messages.invoice_pdf') }}
                </a>
            @endif
            @if($payment->payable_type == 'App\Models\Order' && $payment->payable)
                <a href="{{ route('orders.view', ['order' => $payment->payable_id]) }}" wire:navigate class="btn btn-primary btn-sm">
                    {{ __('messages.view_service') }}
                </a>
            @endif
        </div>
    </div>

    @if($payment->isNotPaid())
        <div class="payment-grid">
            <form wire:submit="payPayment()" class="rack-card payment-panel">
                <h2>{{ __('messages.complete_payment') }}</h2>
                <p class="payment-muted">{{ __('messages.choose_payment_method') }}</p>

                @error('gateway_config_id')
                    <x-theme::form.error :text="$message"/>
                @enderror

                <x-theme::checkout.gateway-list :exclude-balance-gateway="true" :handler="$payment->handler" />

                <div class="payment-divider"></div>

                <x-theme::checkout.billing-fields :company-name="$company_name" :country="$country" />

                <button type="submit" class="btn btn-primary payment-submit">{{ __('messages.pay_now') }}</button>
            </form>

            <aside class="rack-card payment-summary-card">
                <h2>{{ __('messages.summary') }}</h2>
                <div class="payment-rows">
                    <dl>
                        <dt>{{ __('messages.subtotal') }}</dt>
                        <dd>{{ price($payment->subtotal, in: $payment->currency) }}</dd>
                    </dl>
                    @if(settings('enable_sales_tax', false))
                        <dl>
                            <dt>{{ $this->salesTaxTotal['tax_name'] }} {{ $this->salesTaxTotal['tax_rate'] != 0 ? "({$this->salesTaxTotal['tax_rate']}%)" : '' }}</dt>
                            <dd>{{ ($this->salesTaxTotal['tax_amount'] != 0) ? price($this->salesTaxTotal['tax_amount'], in: $payment->currency) : '-' }}</dd>
                        </dl>
                    @endif
                    <dl class="payment-total">
                        <dt>{{ __('messages.total') }}</dt>
                        <dd>{{ settings('enable_sales_tax', false) ? price($this->salesTaxTotal['amount_after_tax'], in: $payment->currency) : price($payment->subtotal, in: $payment->currency) }}</dd>
                    </dl>
                </div>
            </aside>
        </div>
    @else
        <div class="payment-grid">
            <div class="rack-card payment-panel">
                <div class="payment-panel-head">
                    <h2>{{ __('messages.payment_details') }}</h2>
                    @if($payment->isPaid())
                        <span class="badge badge-success">{{ __('messages.paid') }}</span>
                    @else
                        <span class="badge badge-warning">{{ ucfirst($payment->status) }}</span>
                    @endif
                </div>

                <div class="payment-rows">
                    <dl><dt>{{ __('messages.paid_on') }}</dt><dd>{{ $payment->paid_at ? $payment->paid_at->format(settings('date_format', 'D M Y H:i')) : '-' }}</dd></dl>
                    <dl><dt>{{ __('messages.created_on') }}</dt><dd>{{ $payment->created_at ? $payment->created_at->format(settings('date_format', 'D M Y H:i')) : '-' }}</dd></dl>
                    <dl><dt>{{ __('messages.invoice_id') }}</dt><dd>{{ $payment->invoice_id ?? '-' }}</dd></dl>
                    <dl><dt>{{ __('messages.payment_method') }}</dt><dd>{{ $payment->gatewayConfig?->display_name ?? 'N/A' }}</dd></dl>
                    <dl><dt>{{ __('messages.transaction') }}</dt><dd>{{ $payment->transaction_id ?? '-' }}</dd></dl>
                    <dl><dt>{{ __('messages.currency') }}</dt><dd>{{ $payment->currency ?? '-' }}</dd></dl>
                </div>

                <div class="payment-actions">
                    @if($payment->payable_type == 'App\Models\Order' && $payment->payable)
                        <a href="{{ route('orders.view', ['order' => $payment->payable_id]) }}" wire:navigate class="btn btn-primary">{{ __('messages.view_service') }}</a>
                    @endif
                    <a href="{{ route('dashboard') }}" wire:navigate class="btn btn-secondary">{{ __('messages.back_to_panel') }}</a>
                </div>
            </div>

            <aside class="payment-stack">
                <div class="rack-card payment-summary-card">
                    <h2>{{ __('messages.summary') }}</h2>
                    <div class="payment-rows">
                        <dl><dt>{{ __('messages.subtotal') }}</dt><dd>{{ price($payment->subtotal, in: $payment->currency) }}</dd></dl>
                        @if(settings('enable_sales_tax', false))
                            <dl><dt>{{ __('messages.taxes') }}</dt><dd>{{ price($payment->tax, in: $payment->currency) }}</dd></dl>
                        @endif
                        <dl><dt>{{ __('messages.discount') }}</dt><dd>{{ price($payment->discount, in: $payment->currency) }}</dd></dl>
                        <dl class="payment-total"><dt>{{ __('messages.total') }}</dt><dd>{{ price($payment->total, in: $payment->currency) }}</dd></dl>
                    </div>
                </div>

                @if($payment->taxDetails)
                    <div class="rack-card payment-summary-card">
                        <h2>{{ __('messages.tax_details') }}</h2>
                        <div class="payment-rows">
                            @if($payment->taxDetails['company_name'])<dl><dt>{{ __('messages.company') }}</dt><dd>{{ $payment->taxDetails['company_name'] }}</dd></dl>@endif
                            @if($payment->taxDetails['tax_id'])<dl><dt>{{ __('messages.tax_id') }}</dt><dd>{{ $payment->taxDetails['tax_id'] }}</dd></dl>@endif
                            @if($payment->taxDetails['country'])<dl><dt>{{ __('messages.country') }}</dt><dd>{{ \App\Facades\World::countryName($payment->taxDetails['country']) }}</dd></dl>@endif
                            @if($payment->taxDetails['region'])<dl><dt>{{ __('messages.region') }}</dt><dd>{{ $payment->taxDetails['region'] }}</dd></dl>@endif
                            @if($payment->taxDetails['tax_name'])<dl><dt>{{ __('messages.tax') }}</dt><dd>{{ $payment->taxDetails['tax_name'] }} {{ $payment->taxDetails['tax_rate'] ?? '0' }}%</dd></dl>@endif
                            <dl><dt>{{ __('messages.total_tax') }}</dt><dd>{{ price($payment->tax, in: $payment->currency) }}</dd></dl>
                        </div>
                    </div>
                @endif
            </aside>
        </div>
    @endif
</section>
