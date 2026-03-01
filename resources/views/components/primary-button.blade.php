@props(['type' => 'submit'])

<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => 'btn-gradient'
    ]) }}
>
    {{ $slot }}
</button>