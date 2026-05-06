@props(['active' => false, 'href' => '#'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => $active ? 'border-b-2 border-brand-600 px-3 py-2 text-sm font-bold text-brand-700' : 'border-b-2 border-transparent px-3 py-2 text-sm font-semibold text-slate-500 hover:text-brand-700']) }}>
    {{ $slot }}
</a>
