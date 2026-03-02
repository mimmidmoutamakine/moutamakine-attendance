<nav x-data="{ open: false }"
     class="bg-white rounded-3xl border border-slate-200/60 shadow-sm px-4 py-3">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo + brand -->
                <div class="hidden sm:flex shrink-0 items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <x-application-logo class="block h-9 w-auto" />
                        <span class="hidden sm:inline text-sm font-semibold text-orange-400 tracking-wide">
                            Moutamakine
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex">
                    @php
                        $role = auth()->user()->role ?? null;
                    @endphp

                    {{-- Admin links --}}
                    @if ($role === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            <div class="flex items-center gap-2">
                                {{-- Dashboard icon --}}
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 12L12 3L21 12" stroke="currentColor" stroke-width="1.7"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5 10V21H19V10" stroke="currentColor" stroke-width="1.7"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span>Dashboard</span>
                            </div>
                        </x-nav-link>

                        <x-nav-link :href="route('admin.students.index')" :active="request()->routeIs('admin.students.*')">
                            <div class="flex items-center gap-2">
                                {{-- Students icon --}}
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor"
                                          stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M17 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor"
                                          stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3 21v-1a4 4 0 0 1 4-4h2" stroke="currentColor" stroke-width="1.7"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M21 21v-1a4 4 0 0 0-4-4h-2" stroke="currentColor" stroke-width="1.7"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span>Students</span>
                            </div>
                        </x-nav-link>

                        <x-nav-link :href="route('admin.groups.index')" :active="request()->routeIs('admin.groups.*')">
                            <div class="flex items-center gap-2">
                                {{-- Groups icon --}}
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="4" width="7" height="7" rx="1.5"
                                          stroke="currentColor" stroke-width="1.7"/>
                                    <rect x="14" y="4" width="7" height="7" rx="1.5"
                                          stroke="currentColor" stroke-width="1.7"/>
                                    <rect x="3" y="13" width="7" height="7" rx="1.5"
                                          stroke="currentColor" stroke-width="1.7"/>
                                    <rect x="14" y="13" width="7" height="7" rx="1.5"
                                          stroke="currentColor" stroke-width="1.7"/>
                                </svg>
                                <span>Groups</span>
                            </div>
                        </x-nav-link>

                        <x-nav-link :href="route('admin.teacher-attendance.index')" :active="request()->routeIs('admin.teacher-attendance.*')">
                            <div class="flex items-center gap-2">
                                {{-- Clipboard icon --}}
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <rect x="5" y="4" width="14" height="16" rx="2"
                                          stroke="currentColor" stroke-width="1.7"/>
                                    <path d="M9 4.5h6" stroke="currentColor" stroke-width="1.7"
                                          stroke-linecap="round"/>
                                    <path d="M9 9h6" stroke="currentColor" stroke-width="1.7"
                                          stroke-linecap="round"/>
                                    <path d="M9 13h4" stroke="currentColor" stroke-width="1.7"
                                          stroke-linecap="round"/>
                                </svg>
                                <span>Teacher Attendance</span>
                            </div>
                        </x-nav-link>
                        <x-nav-link :href="route('admin.teachers.index')" :active="request()->routeIs('admin.teachers.*')">
                            <div class="flex items-center gap-2">
                                {{-- Teacher icon --}}
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"
                                        stroke="currentColor" stroke-width="1.7"
                                        stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M4 20a8 8 0 0 1 16 0"
                                        stroke="currentColor" stroke-width="1.7"
                                        stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span>Teachers</span>
                            </div>
                        </x-nav-link>
                    @endif

                    {{-- Teacher links --}}
                    @if ($role === 'teacher')
                        <x-nav-link :href="route('teacher.dashboard')" :active="request()->routeIs('teacher.*')">
                            <div class="flex items-center gap-2">
                                {{-- Book / class icon --}}
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 4h9a3 3 0 0 1 3 3v11" stroke="currentColor"
                                          stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5 4v14a2 2 0 0 0 2 2h10" stroke="currentColor"
                                          stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 8h5" stroke="currentColor" stroke-width="1.7"
                                          stroke-linecap="round"/>
                                </svg>
                                <span>My Groups</span>
                            </div>
                        </x-nav-link>
                    @endif
                </div>
            </div>
            <!-- Settings Dropdown -->
        <div class="hidden sm:flex sm:items-center sm:ml-6">
            <x-dropdown align="right" width="48">
                {{-- TRIGGER: only the ninja avatar button, no name text --}}
                <x-slot name="trigger">
                    <button
                        class="flex items-center rounded-full border-2 border-orange-300 bg-gradient-to-br from-orange-500 to-pink-500 p-[2px]
                            text-sm focus:outline-none focus:ring-2 focus:ring-orange-300 focus:ring-offset-2 focus:ring-offset-white">
                        <span
                            class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-slate-900 text-white text-base font-semibold">
                            {{-- simple ninja-ish icon (mask) --}}
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="9" fill="#0f172a"/>
                                <rect x="6" y="9" width="12" height="4" rx="2" fill="#e5e7eb"/>
                                <circle cx="10" cy="11" r="0.9" fill="#0f172a"/>
                                <circle cx="14" cy="11" r="0.9" fill="#0f172a"/>
                            </svg>
                        </span>
                    </button>
                </x-slot>

                {{-- CONTENT: this is ONLY the dropdown panel, and it is CLOSED
                    BEFORE the rest of the layout, so nothing else goes inside it --}}
                <x-slot name="content">
                    {{-- Header inside dropdown: name + role --}}
                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-sm font-medium text-gray-900">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ ucfirst($role ?? 'admin') }}
                        </p>
                    </div>

                    {{-- Profile link --}}
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    {{-- Logout --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>

        {{-- MOBILE HEADER ROW --}}
        <div class="flex items-center justify-between w-full sm:hidden">

            {{-- LEFT: Avatar --}}
            <x-dropdown align="left" width="48">
                <x-slot name="trigger">
                    <button
                        class="flex items-center rounded-full border-2 border-orange-300 bg-gradient-to-br from-orange-500 to-pink-500 p-[2px]
                            focus:outline-none focus:ring-2 focus:ring-orange-300">
                        <span
                            class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-slate-900 text-white">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="9" fill="#0f172a"/>
                                <rect x="6" y="9" width="12" height="4" rx="2" fill="#e5e7eb"/>
                                <circle cx="10" cy="11" r="0.9" fill="#0f172a"/>
                                <circle cx="14" cy="11" r="0.9" fill="#0f172a"/>
                            </svg>
                        </span>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-sm font-medium text-gray-900">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ ucfirst(auth()->user()->role ?? 'admin') }}
                        </p>
                    </div>

                    <x-dropdown-link :href="route('profile.edit')">
                        Profile
                    </x-dropdown-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>

            {{-- CENTER: Logo --}}
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="block h-8 w-auto" />
            </a>

            {{-- RIGHT: Burger --}}
            <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-xl text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }"
                        class="inline-flex"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }"
                        class="hidden"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

        </div>
        </div>
    </div>

    <!-- Responsive Menu (mobile) -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @php
                $role = auth()->user()->role ?? null;
            @endphp

            {{-- Admin links (mobile) --}}
            @if ($role === 'admin')
                <x-responsive-nav-link
                    :href="route('admin.dashboard')"
                    :active="request()->routeIs('admin.dashboard')"
                >
                    Dashboard
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('admin.students.index')"
                    :active="request()->routeIs('admin.students.*')"
                >
                    Students
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('admin.groups.index')"
                    :active="request()->routeIs('admin.groups.*')"
                >
                    Groups
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('admin.teacher-attendance.index')"
                    :active="request()->routeIs('admin.teacher-attendance.*')"
                >
                    Teacher Attendance
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('admin.teachers.index')"
                    :active="request()->routeIs('admin.teachers.*')"
                >
                    {{ __('Teachers') }}
                </x-responsive-nav-link>
            @endif

            {{-- Teacher links (mobile) --}}
            @if ($role === 'teacher')
                <x-responsive-nav-link
                    :href="route('teacher.dashboard')"
                    :active="request()->routeIs('teacher.*')"
                >
                    My Groups
                </x-responsive-nav-link>
            @endif
        </div>
    </div> 
</nav>