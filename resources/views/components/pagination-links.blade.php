@php
    if (!isset($scrollTo)) {
        $scrollTo = 'body';
    }

    $scrollIntoViewJsSnippet = ($scrollTo !== false)
        ? <<<JS
           (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
        JS
        : '';
@endphp

<div>
    @if ($paginator->hasPages())
        <nav>
            <div class="pagination">
                <div class="d-flex gap-2">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <div class="page-item disabled" aria-disabled="true">
                            <span class="page-link">@lang('pagination.previous')</span>
                        </div>
                    @else
                        @if (method_exists($paginator, 'getCursorName'))
                            <div class="page-item">
                                <button dusk="previousPage" type="button" class="page-link"
                                    wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $paginator->previousCursor()->encode() }}"
                                    wire:click="setPage('{{ $paginator->previousCursor()->encode() }}','{{ $paginator->getCursorName() }}')"
                                    x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled">
                                    @lang('pagination.previous')
                                </button>
                            </div>
                        @else
                            <div class="page-item">
                                <button type="button" class="page-link prev-btn" wire:loading.attr="disabled"
                                    dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                                    wire:click="previousPage('{{ $paginator->getPageName() }}')"
                                    x-on:click="{{ $scrollIntoViewJsSnippet }}">
                                    @lang('pagination.previous')
                                </button>
                            </div>
                        @endif
                    @endif

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        @if (method_exists($paginator, 'getCursorName'))
                            <div class="page-item">
                                <button dusk="nextPage" type="button" class="page-link"
                                    wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $paginator->nextCursor()->encode() }}"
                                    wire:click="setPage('{{ $paginator->nextCursor()->encode() }}','{{ $paginator->getCursorName() }}')"
                                    x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled">
                                    @lang('pagination.next')
                                </button>
                            </div>
                        @else
                            <div class="page-item">
                                <button type="button" class="page-link next-btn" wire:loading.attr="disabled"
                                    dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                                    wire:click="nextPage('{{ $paginator->getPageName() }}')"
                                    x-on:click="{{ $scrollIntoViewJsSnippet }}">
                                    @lang('pagination.next')
                                </button>
                            </div>
                        @endif
                    @else
                        <div class="page-item disabled" aria-disabled="true">
                            <span class="page-link">@lang('pagination.next')</span>
                        </div>
                    @endif
                </div>

                <div class="d-flex gap-2">
                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <div class="page-item disabled" aria-disabled="true">
                                <span class="page-link">{{ $element }}</span>
                            </div>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <div class="page-item active"
                                        wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}"
                                        aria-current="page">
                                        <span class="page-link">{{ $page }}</span>
                                    </div>
                                @else
                                    <div class="page-item"
                                        wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}">
                                        <button type="button" class="page-link"
                                            wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                            x-on:click="{{ $scrollIntoViewJsSnippet }}">
                                            {{ $page }}
                                        </button>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
        </nav>
    @endif
</div>
