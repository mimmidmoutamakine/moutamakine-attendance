@props(['active'])

@php
    $classes = $active
                ? 'inline-flex items-center px-3 py-2 rounded-xl text-sm font-semibold text-slate-900 bg-slate-100 shadow-sm transition'
                : 'inline-flex items-center px-3 py-2 rounded-xl text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>