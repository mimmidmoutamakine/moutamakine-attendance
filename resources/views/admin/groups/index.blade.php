<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Groups
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if (session('status'))
            <div class="mb-4 text-green-500">
                {{ session('status') }}
            </div>
        @endif

        <a href="{{ route('admin.groups.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded">
            + New Group
        </a>

        <div class="mt-6 bg-white border border-slate-200 p-4 rounded">
            <table class="w-full text-sm">
                <thead>
                    <tr>
                        <th class="text-left">Name</th>
                        <th class="text-left">Level</th>
                        <th class="text-left">Students</th>
                        <th class="text-left">Teacher</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groups as $group)
                        <tr class="border-t border-gray-700">
                            <td>{{ $group->name }}</td>
                            <td>{{ $group->level }}</td>
                            <td>{{ $group->students_count }}</td>
                            <td class="px-4 py-3 text-slate-700">
                                @php
                                    // Get first teacher (you currently only have one)
                                    $teacher = $group->teachers->first();
                                    $teacherName = optional(optional($teacher)->user)->name;
                                @endphp

                                {{ $teacherName ?? '—' }}
                            </td>
                            <td>
                                <a href="{{ route('admin.groups.edit', $group) }}"
                                   class="text-blue-400">Edit</a>
                                |
                                <form action="{{ route('admin.groups.destroy', $group) }}"
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-400"
                                            onclick="return confirm('Delete group?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>