<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            New Student
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white border border-slate-200 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($errors->any())
                        <div class="mb-4 text-red-500 text-sm">
                            <ul class="list-disc pl-4">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.students.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm mb-1">Full Name *</label>
                            <input type="text" name="full_name" value="{{ old('full_name') }}"
                                   class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-sky-400 focus:ring-2 focus:ring-sky-300/70 transition-colors duration-150">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm mb-1">Date of Birth</label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                                   class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-sky-400 focus:ring-2 focus:ring-sky-300/70 transition-colors duration-150">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm mb-1">Parent Name</label>
                            <input type="text" name="parent_name" value="{{ old('parent_name') }}"
                                   class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-sky-400 focus:ring-2 focus:ring-sky-300/70 transition-colors duration-150">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm mb-1">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                   class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-sky-400 focus:ring-2 focus:ring-sky-300/70 transition-colors duration-150">
                        </div>

                        <div class="mb-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="active" value="1" checked
                                       class="rounded border-gray-300">
                                <span class="ml-2 text-sm">Active</span>
                            </label>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm mb-1">Notes</label>
                            <textarea
                                name="notes"
                                id="notes"
                                rows="4"
                                class="block w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm
                                    text-slate-900 shadow-sm placeholder:text-slate-400
                                    focus:border-sky-400 focus:ring-2 focus:ring-sky-300/70 focus:ring-offset-0
                                    transition-colors duration-150"
                            >{{ old('notes') }}</textarea>
                        </div>

                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.students.index') }}"
                               class="px-4 py-2 text-sm text-gray-600 ">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white text-sm rounded-xl hover:bg-blue-500">
                                Save Student
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>