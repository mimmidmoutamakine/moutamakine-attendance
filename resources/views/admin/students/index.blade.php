<x-app-layout>
    <x-slot name="header">
        Students
    </x-slot>

    <div class="py-4 sm:py-6">
        {{-- Top actions --}}
        <div class="flex justify-between items-center mb-4 sm:mb-5">
            <h2 class="section-title m-0">All Students</h2>

            <a href="{{ route('admin.students.create') }}" class="btn-gradient">
                + New Student
            </a>
        </div>

        {{-- Table card --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
            <div class="space-y-3">

                @forelse ($students as $student)

                    <div class="bg-white rounded-2xl border border-slate-200 p-4 flex justify-between items-center hover:shadow-md transition">

                        <div>
                            <div class="font-semibold text-slate-900">
                                {{ $student->full_name }}
                            </div>

                            <div class="text-sm text-slate-500">
                                {{ $student->phone ?? '—' }}
                                ·
                                {{ $student->active ? 'Active' : 'Inactive' }}
                            </div>
                        </div>

                        <div class="flex items-center gap-3 text-sm font-medium">
                            <a href="{{ route('admin.students.edit', $student) }}"
                            class="text-blue-600 hover:text-blue-800">
                                Edit
                            </a>

                            <form action="{{ route('admin.students.destroy', $student) }}"
                                method="POST"
                                onsubmit="return confirm('Delete this student?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-rose-600 hover:text-rose-800">
                                    Delete
                                </button>
                            </form>
                        </div>

                    </div>

                @empty
                    <div class="text-center text-slate-400 py-6">
                        No students yet.
                    </div>
                @endforelse

            </div>

            <div class="px-4 py-3 border-t border-slate-100">
                {{ $students->links() }}
            </div>
        </div>
    </div>
</x-app-layout>