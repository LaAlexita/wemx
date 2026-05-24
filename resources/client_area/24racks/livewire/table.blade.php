<?php

use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use Livewire\Volt\Component;

new class extends Component
{
    public string $title = '';

    public string $description = '';

    public string $badge = '';

    #[Locked]
    public bool $searchable = true;

    #[Url]
    public string $search = '';

    public array $actionButton = [];

    #[Locked]
    public array $columns = [];

    #[Locked]
    public array $rows = [];

    public int $page = 1;

    public int $perPage = 10;

    #[Computed]
    public function filteredRows(): array
    {
        if (empty($this->search) || !$this->searchable) {
            return $this->rows;
        }

        return array_filter($this->rows, function ($row) {
            foreach ($row as $cell) {
                if (stripos(strip_tags($cell), $this->search) !== false) {
                    return true;
                }
            }

            return false;
        });
    }

    #[Computed]
    public function totalPages(): int
    {
        $count = count($this->filteredRows);

        return $count === 0 ? 1 : (int) ceil($count / $this->perPage);
    }

    #[Computed]
    public function paginatedRows(): array
    {
        $rows = array_values($this->filteredRows);
        $start = ($this->page - 1) * $this->perPage;

        return array_slice($rows, $start, $this->perPage);
    }

    public function updatedSearch(): void
    {
        $this->page = 1;
    }

    public function updatedPerPage($value): void
    {
        $this->perPage = (int) $value;
        $this->page = 1;
    }

    public function previousPage(): void
    {
        $this->page = max(1, $this->page - 1);
    }

    public function nextPage(): void
    {
        $this->page = min($this->totalPages, $this->page + 1);
    }

    public function goToPage(int $page): void
    {
        $this->page = max(1, min($page, $this->totalPages));
    }
};
?>

@php
    $hasHead = $title !== '' || $description !== '' || $badge !== '' || $searchable || !empty($actionButton);
@endphp

<section class="workspace-card">
    @if($hasHead)
        <div class="workspace-card-head">
            <div class="workspace-card-head-text">
                @if($title)
                    <h2 class="h-accent">{{ $title }}</h2>
                @endif
                @if($description)
                    <p>{{ $description }}</p>
                @endif
            </div>

            <div class="workspace-card-head-tools">
                @if($searchable)
                    <label class="rack-table-search">
                        <span class="sr-only">{{ __('messages.search') }}</span>
                        <svg aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8ZM2 8a6 6 0 1 1 10.89 3.476l4.817 4.817a1 1 0 0 1-1.414 1.414l-4.816-4.816A6 6 0 0 1 2 8Z" clip-rule="evenodd"/>
                        </svg>
                        <input type="text" wire:model.live.debounce.250ms="search" placeholder="{{ __('messages.search_placeholder') }}">
                    </label>
                @endif

                @if(!empty($actionButton))
                    <a href="{{ $actionButton['href'] }}" wire:navigate class="btn btn-primary btn-sm">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        {{ $actionButton['label'] }}
                    </a>
                @endif

                @if($badge)
                    <span class="tag tag-brand">{{ $badge }}</span>
                @endif
            </div>
        </div>
    @endif

    <div class="rack-table-scroll">
        <table class="rack-table">
            <thead>
                <tr>
                    @foreach($columns as $column)
                        <th>{{ $column }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @if(count($this->filteredRows) === 0)
                    <tr>
                        <td class="rack-table-empty" colspan="{{ count($columns) }}">
                            <div class="flex flex-col items-center gap-2 py-6">
                                <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24" style="color: var(--text-3); opacity: .6;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2h-4M9 17l3 3 3-3M9 17v-6m3 3V8"/>
                                </svg>
                                <p style="color: var(--text-3); font-size: 13px;">
                                    @if($this->search)
                                        {{ __('messages.no_results_for', ['search' => $this->search]) }}
                                    @else
                                        {{ __('messages.no_data_to_show') }}
                                    @endif
                                </p>
                            </div>
                        </td>
                    </tr>
                @endif

                @foreach($this->paginatedRows as $row)
                    <tr>
                        @foreach($row as $cell)
                            <td>{!! $cell !!}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="workspace-card-foot rack-table-footer">
        <div class="rack-table-per-page">
            <label for="rows">{{ __('messages.rows_per_page') }}</label>
            <select id="rows" wire:model.change="perPage">
                <option value="5">5</option>
                <option value="8">8</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>

            <span>
                @php
                    $total = count($this->filteredRows);
                    $start = $total === 0 ? 0 : (($page - 1) * $perPage) + 1;
                    $end = min($page * $perPage, $total);
                @endphp
                {!! __('messages.pagination_range', [
                    'start' => '<strong>' . $start . '</strong>',
                    'end' => $end,
                    'total' => '<strong>' . $total . '</strong>',
                ]) !!}
            </span>
        </div>

        <div class="rack-table-pagination">
            <button type="button" wire:click="previousPage" @disabled($page <= 1)>
                {{ __('messages.previous_arrow') }}
            </button>
            <span class="rack-table-pagination-info">
                {{ __('messages.page_x_of_y', ['current' => $page, 'total' => $this->totalPages]) }}
            </span>
            <button type="button" wire:click="nextPage" @disabled($page >= $this->totalPages)>
                {{ __('messages.next_arrow') }}
            </button>
        </div>
    </div>
</section>
