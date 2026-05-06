<div {{ $attributes->merge(['class' => 'table-wrapper']) }}>
    <table class="ui-table">
        {{ $slot }}
    </table>
</div>
