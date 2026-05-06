@props(['variant' => 'info'])

@php
    $classes = [
        'success' => 'ui-alert-success',
        'info' => 'ui-alert-info',
        'warning' => 'rounded-md border border-amber-200 bg-amber-50 px-4 py-3 text-sm font-medium text-amber-800',
        'danger' => 'rounded-md border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-800',
    ][$variant] ?? 'ui-alert-info';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
