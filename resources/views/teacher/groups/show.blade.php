<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Attendance - {{ $group->name }}
        </h2>
    </x-slot>

    <div class="mb-4">
        <label class="block mb-1">Select Date</label>
        <input type="date"
            name="attendance_date"
            value="{{ $date }}"
            class="rounded">
    </div>

    <div class="py-6 max-w-5xl mx-auto">

        @if (session('status'))
            <div class="mb-4 text-green-500">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('teacher.groups.store', $group) }}">
            @csrf
                <input type="hidden" name="attendance_date" value="{{ $selectedDate ?? now()->toDateString() }}">
                <!-- stats bar provisoir -->
                @php
                    $presentCount = 0;
                    $absentCount  = 0;
                    $lateCount    = 0;

                    foreach ($students as $s) {
                        if (($s->attendance_status ?? null) === 'P') {
                            $presentCount++;
                        } elseif (($s->attendance_status ?? null) === 'A') {
                            $absentCount++;
                        } elseif (($s->attendance_status ?? null) === 'R') {
                            $lateCount++;
                        }
                    }
                @endphp

                {{-- Summary bar --}}
                <div class="mt-4 mb-4 flex flex-wrap items-center gap-3 text-sm text-slate-700">
                    <span class="font-semibold mr-2">This group:</span>
                    <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-3 py-1">
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        Present: {{ $presentCount }}
                    </span>
                    <span class="inline-flex items-center gap-1 rounded-full bg-rose-50 px-3 py-1">
                        <span class="h-2 w-2 rounded-full bg-rose-500"></span>
                        Absent: {{ $absentCount }}
                    </span>
                    <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-3 py-1">
                        <span class="h-2 w-2 rounded-full bg-amber-400"></span>
                        Late: {{ $lateCount }}
                    </span>
                </div>
            <div class="space-y-3">

                @foreach ($students as $student)
                    @php
                        $status = $student->attendance_status ?? null;

                        // use full_name if you have it, fallback to name
                        $displayName = $student->full_name
                            ?? $student->name
                            ?? 'Unknown student';

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
                            <div class="h-9 w-9 rounded-full bg-sky-100 text-sky-700 flex items-center justify-center text-sm font-semibold">
                                {{ $initials }}
                            </div>
                            <div class="flex flex-col">
                                <span class="font-semibold text-slate-900">
                                    {{ $displayName }}
                                </span>
                                @if ($status)
                                    <span class="text-xs text-slate-500">
                                        @if ($status === 'P') Present
                                        @elseif($status === 'A') Absent
                                        @else Late
                                        @endif
                                        today
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- P / A / R pill toggles --}}
                        <div class="flex gap-3 text-sm font-medium">

                            {{-- Present --}}
                            <label class="cursor-pointer">
                                <input type="radio"
                                    name="attendance[{{ $student->id }}]"
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
                                    name="attendance[{{ $student->id }}]"
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
                                    name="attendance[{{ $student->id }}]"
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

            {{-- Desktop Save (normal button) --}}
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

        <div class="mb-4">
            <form method="GET"
                action="{{ route('teacher.groups.show', $group) }}">

                <input type="date"
                    name="date"
                    value="{{ $date }}"
                    onchange="this.form.submit()"
                    class="rounded">
            </form>
        </div>
    </div>
</x-app-layout>