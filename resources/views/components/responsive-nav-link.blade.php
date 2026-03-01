@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'block pl-4 pr-4 py-2 border-l-4 border-sky-500 bg-sky-50 text-sky-700 text-sm font-medium transition-colors duration-150'
        : 'block pl-4 pr-4 py-2 border-l-4 border-transparent text-slate-600 text-sm font-medium transition-colors duration-150 hover:border-sky-300 hover:bg-sky-50/60';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>