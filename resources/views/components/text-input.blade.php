@props(['disabled' => false])

<input
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
        'class' => 'block w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm
                    text-slate-900 shadow-sm placeholder:text-slate-400
                    focus:border-sky-400 focus:ring-2 focus:ring-sky-300/70 focus:ring-offset-0
                    transition-colors duration-150'
    ]) !!}
>