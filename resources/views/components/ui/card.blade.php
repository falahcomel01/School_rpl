@props(['title' => null, 'description' => null])

<section {{ $attributes->merge(['class' => 'ui-card']) }}>
    @if($title || $description || isset($actions))
        <div class="ui-card-header">
            <div>
                @if($title)
                    <h2 class="text-lg font-bold text-slate-950">{{ $title }}</h2>
                @endif
                @if($description)
                    <p class="mt-1 text-sm text-slate-500">{{ $description }}</p>
                @endif
            </div>
            @isset($actions)
                <div class="flex flex-wrap items-center gap-2">{{ $actions }}</div>
            @endisset
        </div>
    @endif

    {{ $slot }}
</section>
