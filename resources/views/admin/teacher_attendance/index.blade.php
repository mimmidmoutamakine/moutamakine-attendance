<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Teacher Attendance
        </h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8">

        @if (session('status'))
            <div class="mb-4 text-green-500">
                {{ session('status') }}
            </div>
        @endif

        {{-- Date selector --}}
        <form method="GET" action="{{ route('admin.teacher-attendance.index') }}" class="mb-4">
            <label class="mr-2">Date:</label>
            <input type="date"
                   name="date"
                   value="{{ $date }}"
                   class="rounded text-gray-900">
            <button class="ml-2 px-3 py-1 bg-gray-700 text-white rounded">
                Go
            </button>
        </form>

        <form method="POST" action="{{ route('admin.teacher-attendance.store') }}">
            @csrf
            {{-- Keep date in the POST --}}
            <input type="hidden" name="attendance_date" value="{{ $date }}">

            {{-- Summary bar --}}
            <div class="mt-4 mb-4 flex flex-wrap items-center gap-3 text-sm text-slate-700">
                <span class="font-semibold mr-2">Today:</span>
                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-3 py-1">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    Present: {{ $summary['P'] }}
                </span>
                <span class="inline-flex items-center gap-1 rounded-full bg-rose-50 px-3 py-1">
                    <span class="h-2 w-2 rounded-full bg-rose-500"></span>
                    Absent: {{ $summary['A'] }}
                </span>
                <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-3 py-1">
                    <span class="h-2 w-2 rounded-full bg-amber-400"></span>
                    Late: {{ $summary['R'] }}
                </span>
            </div>
            <div class="space-y-3">

                @foreach ($teachers as $teacher)
                    @php
                        $status = $teacher->attendance_status ?? null;

                        // display name from user or teacher model
                        $displayName = optional(optional($teacher)->user)->name
                            ?? $teacher->name
                            ?? 'Unknown teacher';

                        // initials for avatar (max 2 letters)
                        $parts = preg_split('/\s+/', trim($displayName));
                        $initials = '';
                        foreach ($parts as $part) {
                            if ($part !== '') {
                                $initials .= mb_substr($part, 0, 1);
                            }
                            if (mb_strlen($initials) >= 2) break;
                        }
                        $initials = mb_strtoupper($initials);
                    @endphp

                    <div class="bg-white rounded-2xl border border-slate-200 p-4 flex items-center justify-between hover:shadow-lg hover:-translate-y-0.5 transition-all">

                        {{-- Avatar + name --}}
                        <div class="flex items-center gap-3">
                            <div class="h-9 w-9 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center text-sm font-semibold">
                                {{ $initials }}
                            </div>
                            <div class="flex flex-col">
                                <span class="font-semibold text-slate-900">
                                    {{ $displayName }}
                                </span>
                                @if ($status)
                                    <span class="text-xs text-slate-500">
                                        @if ($status === 'P') Present @elseif($status === 'A') Absent @else Late @endif for {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- P / A / R pill toggles --}}
                        <div class="flex gap-3 text-sm font-medium">

                            {{-- Present --}}
                            <label class="cursor-pointer">
                                <input type="radio"
                                    name="attendance[{{ $teacher->id }}]"
                                    value="P"
                                    class="hidden peer"
                                    {{ $status === 'P' ? 'checked' : '' }}>
                                <span class="px-3 py-1 rounded-xl border border-slate-300
                                            transition-all duration-150 ease-out
                                            peer-checked:bg-emerald-500 peer-checked:text-white
                                            peer-checked:shadow-md peer-checked:scale-105">
                                    P
                                </span>
                            </label>

                            {{-- Absent --}}
                            <label class="cursor-pointer">
                                <input type="radio"
                                    name="attendance[{{ $teacher->id }}]"
                                    value="A"
                                    class="hidden peer"
                                    {{ $status === 'A' ? 'checked' : '' }}>
                                <span class="px-3 py-1 rounded-xl border border-slate-300
                                            transition-all duration-150 ease-out
                                            peer-checked:bg-rose-500 peer-checked:text-white
                                            peer-checked:shadow-md peer-checked:scale-105">
                                    A
                                </span>
                            </label>

                            {{-- Late --}}
                            <label class="cursor-pointer">
                                <input type="radio"
                                    name="attendance[{{ $teacher->id }}]"
                                    value="R"
                                    class="hidden peer"
                                    {{ $status === 'R' ? 'checked' : '' }}>
                                <span class="px-3 py-1 rounded-xl border border-slate-300
                                            transition-all duration-150 ease-out
                                            peer-checked:bg-amber-500 peer-checked:text-white
                                            peer-checked:shadow-md peer-checked:scale-105">
                                    R
                                </span>
                            </label>

                        </div>

                    </div>
                @endforeach

            </div>

            {{-- Desktop Save (top-right) --}}
            <div class="mt-6 hidden sm:flex justify-end">
                <x-primary-button>
                    Save Attendance
                </x-primary-button>
            </div>

            {{-- Mobile sticky Save bar --}}
            <div class="sm:hidden fixed inset-x-0 bottom-0 z-20 bg-white/90 border-t border-slate-200 backdrop-blur">
                <div class="mx-auto max-w-4xl px-4 py-3">
                    <x-primary-button class="w-full">
                        Save Attendance
                    </x-primary-button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>