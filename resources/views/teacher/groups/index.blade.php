<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">My Groups</h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto">

        <div class="bg-white border border-slate-200 p-4 rounded">
            @foreach ($groups as $group)
                <div class="border-b border-gray-700 py-3">
                    <a href="{{ route('teacher.groups.show', $group) }}"
                       class="text-blue-400 text-lg">
                        {{ $group->name }}
                    </a>
                    <div class="text-sm text-gray-400">
                        {{ $group->students_count }} students
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>