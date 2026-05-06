@props([
    'variant' => 'primary',
    'type' => 'button',
    'href' => null,
    'loading' => false,
])

@php
    $variants = [
        'primary' => 'ui-button ui-button-primary',
        'secondary' => 'ui-button ui-button-secondary',
        'outline' => 'ui-button ui-button-outline',
        'danger' => 'ui-button ui-button-danger',
        'ghost' => 'ui-button border-transparent bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-950',
    ];
    $classes = $variants[$variant] ?? $variants['primary'];
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($loading)<i class="fa-solid fa-spinner fa-spin"></i>@endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" @disabled($loading || $attributes->get('disabled')) {{ $attributes->merge(['class' => $classes]) }}>
        @if($loading)<i class="fa-solid fa-spinner fa-spin"></i>@endif
        {{ $slot }}
    </button>
@endif
