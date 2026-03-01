<nav x-data="{ open: false }"
     class="bg-white rounded-3xl border border-slate-200/60 shadow-sm px-4 py-3">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo + brand -->
                <div class="shrink-0 flex items-center">
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
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-xl text-gray-500 dark:text-gray-300 bg-white dark:bg-white border border-slate-200 hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none transition">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                Log out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-xl text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none transition">
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
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.students.index')" :active="request()->routeIs('admin.students.*')">
                Students
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.groups.index')" :active="request()->routeIs('admin.groups.*')">
                Groups
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.teacher-attendance.index')" :active="request()->routeIs('admin.teacher-attendance.*')">
                Teacher Attendance
            </x-responsive-nav-link>
        @endif

        {{-- Teacher links (mobile) --}}
        @if ($role === 'teacher')
            <x-responsive-nav-link :href="route('teacher.dashboard')" :active="request()->routeIs('teacher.*')">
                My Groups
            </x-responsive-nav-link>
        @endif
    </div>
</nav>