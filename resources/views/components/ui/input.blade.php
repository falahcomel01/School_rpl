@props(['label' => null, 'name' => null, 'type' => 'text', 'error' => null])

<div class="form-field">
    @if($label)
        <label for="{{ $attributes->get('id', $name) }}">{{ $label }}</label>
    @endif
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $attributes->get('id', $name) }}"
        {{ $attributes->except('id')->merge(['class' => 'w-full']) }}
    >
    @if($error)
        <p class="text-sm font-medium text-rose-600">{{ $error }}</p>
    @endif
</div>
