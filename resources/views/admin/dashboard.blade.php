<x-app-layout>
    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 space-y-8">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold text-slate-900">
                        Dashboard
                    </h1>
                    <p class="text-sm text-slate-500 mt-1">
                        Overview for {{ \Carbon\Carbon::parse($today)->format('d/m/Y') }}
                    </p>
                </div>
            </div>


            {{-- Top stats cards --}}
            <div class="grid gap-4 sm:grid-cols-3">
                {{-- Students --}}
                <div class="relative overflow-hidden rounded-2xl bg-white p-4 border border-sky-100 shadow-lg shadow-sky-100/70">
                    <div class="pointer-events-none absolute -right-8 -top-8 h-24 w-24 rounded-full bg-sky-300/30 blur-2xl"></div>
                    <div class="relative flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-semibold uppercase tracking-wide text-sky-600">
                                Students
                            </span>
                            <div class="h-9 w-9 rounded-xl bg-gradient-to-tr from-sky-500 to-cyan-400 flex items-center justify-center text-white text-lg shadow-md shadow-sky-400/70">
                                👨‍🎓
                            </div>
                        </div>
                        <div class="mt-3 text-3xl font-semibold text-slate-900">
                            {{ $totalStudents }}
                        </div>
                        <p class="mt-1 text-xs text-slate-500">
                            Total registered students.
                        </p>
                    </div>
                </div>

                {{-- Teachers --}}
                <div class="relative overflow-hidden rounded-2xl bg-white p-4 border border-indigo-100 shadow-lg shadow-indigo-100/70">
                    <div class="pointer-events-none absolute -right-8 -top-8 h-24 w-24 rounded-full bg-indigo-300/30 blur-2xl"></div>
                    <div class="relative flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-semibold uppercase tracking-wide text-indigo-600">
                                Teachers
                            </span>
                            <div class="h-9 w-9 rounded-xl bg-gradient-to-tr from-indigo-500 to-fuchsia-400 flex items-center justify-center text-white text-lg shadow-md shadow-fuchsia-400/70">
                                🧑‍🏫
                            </div>
                        </div>
                        <div class="mt-3 text-3xl font-semibold text-slate-900">
                            {{ $totalTeachers }}
                        </div>
                        <p class="mt-1 text-xs text-slate-500">
                            Total active teachers.
                        </p>
                    </div>
                </div>

                {{-- Groups --}}
                <div class="relative overflow-hidden rounded-2xl bg-white p-4 border border-emerald-100 shadow-lg shadow-emerald-100/70">
                    <div class="pointer-events-none absolute -right-8 -top-8 h-24 w-24 rounded-full bg-emerald-300/30 blur-2xl"></div>
                    <div class="relative flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-semibold uppercase tracking-wide text-emerald-600">
                                Groups
                            </span>
                            <div class="h-9 w-9 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-400 flex items-center justify-center text-white text-lg shadow-md shadow-emerald-400/70">
                                📊
                            </div>
                        </div>
                        <div class="mt-3 text-3xl font-semibold text-slate-900">
                            {{ $totalGroups }}
                        </div>
                        <p class="mt-1 text-xs text-slate-500">
                            Language groups currently in the system.
                        </p>
                    </div>
                </div>
            </div>
            {{-- Attendance today cards --}}
            <div class="grid gap-4 lg:grid-cols-2">
                {{-- Student attendance today --}}
                <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">
                                Student Attendance Today
                            </h2>
                            <p class="text-xs text-slate-500">
                                All records for {{ \Carbon\Carbon::parse($today)->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3 text-sm text-slate-700 mt-2">
                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-3 py-1">
                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                            Present: {{ $studentSummaryToday['P'] }}
                        </span>
                        <span class="inline-flex items-center gap-1 rounded-full bg-rose-50 px-3 py-1">
                            <span class="h-2 w-2 rounded-full bg-rose-500"></span>
                            Absent: {{ $studentSummaryToday['A'] }}
                        </span>
                        <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-3 py-1">
                            <span class="h-2 w-2 rounded-full bg-amber-400"></span>
                            Late: {{ $studentSummaryToday['R'] }}
                        </span>
                    </div>
                </div>

                {{-- Teacher attendance today --}}
                <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">
                                Teacher Attendance Today
                            </h2>
                            <p class="text-xs text-slate-500">
                                All records for {{ \Carbon\Carbon::parse($today)->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3 text-sm text-slate-700 mt-2">
                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-3 py-1">
                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                            Present: {{ $teacherSummaryToday['P'] }}
                        </span>
                        <span class="inline-flex items-center gap-1 rounded-full bg-rose-50 px-3 py-1">
                            <span class="h-2 w-2 rounded-full bg-rose-500"></span>
                            Absent: {{ $teacherSummaryToday['A'] }}
                        </span>
                        <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-3 py-1">
                            <span class="h-2 w-2 rounded-full bg-amber-400"></span>
                            Late: {{ $teacherSummaryToday['R'] }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Last 7 days simple overview --}}
            <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <h2 class="text-sm font-semibold text-slate-900">
                            Student Attendance · Last 7 Days
                        </h2>
                        <p class="text-xs text-slate-500">
                            Total attendance records per day.
                        </p>
                    </div>
                </div>

                @if ($studentLast7->isEmpty())
                    <p class="text-sm text-slate-500">
                        No attendance recorded in the last 7 days.
                    </p>
                @else
                    <div class="grid gap-3 sm:grid-cols-7 text-xs text-slate-600 mt-2">
                        @foreach ($studentLast7 as $row)
                            <div class="flex flex-col items-center">
                                <span class="text-sm font-semibold text-slate-900">
                                    {{ $row->total }}
                                </span>
                                <span class="mt-1 text-[11px] text-slate-500">
                                    {{ \Carbon\Carbon::parse($row->attendance_date)->format('d/m') }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>