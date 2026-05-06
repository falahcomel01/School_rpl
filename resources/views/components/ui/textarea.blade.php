@props(['label' => null, 'name' => null, 'error' => null])

<div class="form-field">
    @if($label)
        <label for="{{ $attributes->get('id', $name) }}">{{ $label }}</label>
    @endif
    <textarea
        name="{{ $name }}"
        id="{{ $attributes->get('id', $name) }}"
        {{ $attributes->except('id')->merge(['class' => 'w-full']) }}
    >{{ $slot }}</textarea>
    @if($error)
        <p class="text-sm font-medium text-rose-600">{{ $error }}</p>
    @endif
</div>
