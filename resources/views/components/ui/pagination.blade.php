@props(['items'])

@if($items->hasPages())
    <div {{ $attributes->merge(['class' => 'pagination']) }}>
        {{ $items->links() }}
    </div>
@endif
