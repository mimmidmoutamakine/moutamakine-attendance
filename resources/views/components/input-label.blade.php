@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-xs font-semibold text-slate-600 mb-1 tracking-wide']) }}>
    @isset($value)
        {{ $value }}
    @else
        {{ $slot }}
    @endisset
</label>