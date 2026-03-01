<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            Edit Teacher
        </h2>
    </x-slot>

    <div class="pb-12 pt-6">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            <div class="rounded-3xl bg-white/80 p-6 shadow-soft">

                <form method="POST" action="{{ route('admin.teachers.update', $teacher) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- Name --}}
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-600">
                            Full Name *
                        </label>
                        <input type="text"
                               name="name"
                               value="{{ old('name', $teacher->user->name) }}"
                               class="form-input-class"
                               required>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-600">
                            Email *
                        </label>
                        <input type="email"
                               name="email"
                               value="{{ old('email', $teacher->user->email) }}"
                               class="form-input-class"
                               required>
                    </div>

                    {{-- Password (optional) --}}
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-600">
                            New Password (leave blank to keep current)
                        </label>
                        <input type="password"
                               name="password"
                               class="form-input-class">
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label class="mb-1 block text-sm font-medium text-slate-600">
                            Phone
                        </label>
                        <input type="text"
                               name="phone"
                               value="{{ old('phone', $teacher->phone) }}"
                               class="form-input-class">
                    </div>

                    {{-- Active --}}
                    <div class="flex items-center gap-2">
                        <input type="checkbox"
                               name="active"
                               value="1"
                               class="h-4 w-4 rounded border-slate-300 text-blue-500 focus:ring-blue-400"
                               {{ old('active', $teacher->active) ? 'checked' : '' }}>
                        <span class="text-sm text-slate-600">Active</span>
                    </div>

                    <div class="flex justify-end gap-3 pt-2">
                        <a href="{{ route('admin.teachers.index') }}"
                           class="rounded-full border border-slate-200 px-4 py-2 text-sm font-medium text-slate-500 hover:bg-slate-50">
                            Cancel
                        </a>

                        <button type="submit"
                                class="rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 px-5 py-2 text-sm font-semibold text-white shadow-soft hover:shadow-soft-lg">
                            Update Teacher
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>