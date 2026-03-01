<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            New Group
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">

        <form method="POST" action="{{ route('admin.groups.store') }}">
            @csrf

            <div class="mb-4">
                <label>Name *</label>
                <input type="text" name="name" class="w-full rounded">
            </div>

            <div class="mb-4">
                <label>Level</label>
                <input type="text" name="level" class="w-full rounded">
            </div>

            <div class="mb-4">
                <label>Schedule Info</label>
                <input type="text" name="schedule_info" class="w-full rounded">
            </div>

            <div class="mb-4">
                <label>Assign Teachers</label>
                <select name="teachers[]" multiple class="w-full rounded">
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">
                            {{ $teacher->user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>Assign Students</label>
                <select name="students[]" multiple class="w-full rounded">
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">
                            {{ $student->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                Save Group
            </button>
        </form>

    </div>
</x-app-layout>