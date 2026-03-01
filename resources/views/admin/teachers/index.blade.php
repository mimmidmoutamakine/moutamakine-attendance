<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            Teachers
        </h2>
    </x-slot>

    <div class="pb-12 pt-6">
        <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-end">
                <a href="{{ route('admin.teachers.create') }}"
                   class="inline-flex items-center rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 px-4 py-2 text-sm font-semibold text-white shadow-soft hover:shadow-soft-lg">
                    + New Teacher
                </a>
            </div>

            <div class="overflow-hidden rounded-3xl bg-white/80 p-6 shadow-soft">
                <table class="min-w-full text-left text-sm">
                    <thead class="border-b border-slate-100 text-xs font-semibold uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Phone</th>
                            <th class="px-4 py-3">Active</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($teachers as $teacher)
                            <tr>
                                <td class="px-4 py-3 text-slate-800">
                                    {{ $teacher->user->name }}
                                </td>
                                <td class="px-4 py-3 text-slate-600">
                                    {{ $teacher->user->email }}
                                </td>
                                <td class="px-4 py-3 text-slate-600">
                                    {{ $teacher->phone ?? '—' }}
                                </td>
                                <td class="px-4 py-3">
                                    @if ($teacher->active)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-slate-50 px-3 py-1 text-xs font-medium text-slate-500">
                                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right text-sm">
                                    <a href="{{ route('admin.teachers.edit', $teacher) }}"
                                       class="text-blue-600 hover:text-blue-700">Edit</a>

                                    <form action="{{ route('admin.teachers.destroy', $teacher) }}"
                                          method="POST"
                                          class="inline-block"
                                          onsubmit="return confirm('Delete this teacher?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="ml-2 text-red-500 hover:text-red-600">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-slate-400">
                                    No teachers yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>