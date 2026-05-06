@props(['variant' => 'info'])

@php
    $classes = [
        'info' => 'ui-badge ui-badge-info',
        'success' => 'ui-badge ui-badge-success',
        'warning' => 'ui-badge ui-badge-warning',
        'neutral' => 'ui-badge badge-gray',
    ][$variant] ?? 'ui-badge ui-badge-info';
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</span>
