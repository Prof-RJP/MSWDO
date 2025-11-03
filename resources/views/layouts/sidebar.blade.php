<div x-data="{ showSidebar: false }" class="relative flex w-full flex-col md:flex-row">
    <!-- This allows screen readers to skip the sidebar and go directly to the main content. -->
    <a class="sr-only" href="#main-content">skip to the main content</a>

    <!-- dark overlay for when the sidebar is open on smaller screens  -->
    <div x-cloak x-show="showSidebar" class="fixed inset-0 z-10  backdrop-blur-xs md:hidden" aria-hidden="true"
        x-on:click="showSidebar = false" x-transition.opacity></div>

    <nav x-cloak
        class="fixed left-0 z-20 flex h-svh w-60 shrink-0 flex-col border-r border-neutral-300 bg-neutral-50 p-4 transition-transform duration-300 md:w-64 md:translate-x-0 md:relative dark:border-neutral-700 dark:bg-neutral-900"
        x-bind:class="showSidebar ? 'translate-x-0' : '-translate-x-60'" aria-label="sidebar navigation">
        <!-- logo  -->
        <a href="#" class="ml-2 w-fit text-2xl font-bold text-neutral-900 dark:text-white">
            <span class="sr-only">homepage</span>
            <img src="{{ asset('images/logo.jpg') }}" class="rounded-full" alt="">
        </a>


        <hr class="my-3">
        <!-- sidebar links  -->
        <div class="flex flex-col gap-2 overflow-y-auto pb-6">

            <a href="{{ route('dashboard') }}"
                class="flex items-center rounded-sm gap-2 px-2 py-1.5 text-sm font-medium text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white {{ request()->routeIs('dashboard')
                    ? 'text-neutral-900 bg-black/5 dark:text-white dark:bg-white/5'
                    : 'text-neutral-600 dark:text-neutral-300' }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0"
                    aria-hidden="true">
                    <path
                        d="M15.5 2A1.5 1.5 0 0 0 14 3.5v13a1.5 1.5 0 0 0 1.5 1.5h1a1.5 1.5 0 0 0 1.5-1.5v-13A1.5 1.5 0 0 0 16.5 2h-1ZM9.5 6A1.5 1.5 0 0 0 8 7.5v9A1.5 1.5 0 0 0 9.5 18h1a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 10.5 6h-1ZM3.5 10A1.5 1.5 0 0 0 2 11.5v5A1.5 1.5 0 0 0 3.5 18h1A1.5 1.5 0 0 0 6 16.5v-5A1.5 1.5 0 0 0 4.5 10h-1Z" />
                </svg>
                <span>Dashboard</span>
            </a>



            <a href="{{ route('admin.client') }}"
                class="flex items-center rounded-sm gap-2 px-2 py-1.5 text-sm font-medium text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white {{ request()->routeIs('admin.client')
                    ? 'text-neutral-900 bg-black/5 dark:text-white dark:bg-white/5'
                    : 'text-neutral-600 dark:text-neutral-300' }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0"
                    aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M10 2c-2.236 0-4.43.18-6.57.524C1.993 2.755 1 4.014 1 5.426v5.148c0 1.413.993 2.67 2.43 2.902 1.168.188 2.352.327 3.55.414.28.02.521.18.642.413l1.713 3.293a.75.75 0 0 0 1.33 0l1.713-3.293a.783.783 0 0 1 .642-.413 41.102 41.102 0 0 0 3.55-.414c1.437-.231 2.43-1.49 2.43-2.902V5.426c0-1.413-.993-2.67-2.43-2.902A41.289 41.289 0 0 0 10 2ZM6.75 6a.75.75 0 0 0 0 1.5h6.5a.75.75 0 0 0 0-1.5h-6.5Zm0 2.5a.75.75 0 0 0 0 1.5h3.5a.75.75 0 0 0 0-1.5h-3.5Z"
                        clip-rule="evenodd" />
                </svg>
                <span>Client</span>
            </a>
            <a href="{{ route('admin.AICS') }}"
                class="flex items-center rounded-sm gap-2 px-2 py-1.5 text-sm font-medium text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white {{ request()->routeIs('admin.AICS')
                    ? 'text-neutral-900 bg-black/5 dark:text-white dark:bg-white/5'
                    : 'text-neutral-600 dark:text-neutral-300' }}">
                <svg class="shrink-0 size-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M11 4.717c-2.286-.58-4.16-.756-7.045-.71A1.99 1.99 0 0 0 2 6v11c0 1.133.934 2.022 2.044 2.007 2.759-.038 4.5.16 6.956.791V4.717Zm2 15.081c2.456-.631 4.198-.829 6.956-.791A2.013 2.013 0 0 0 22 16.999V6a1.99 1.99 0 0 0-1.955-1.993c-2.885-.046-4.76.13-7.045.71v15.081Z"
                        clip-rule="evenodd" />
                </svg>
                <span>AICS</span>
            </a>
            <a href="{{ route('admin.senior') }}"
                class="flex items-center rounded-sm gap-2 px-2 py-1.5 text-sm font-medium text-neutral-600 underline-offset-2
                    hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden
                    dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white
                    {{ request()->routeIs('admin.senior')
                        ? 'text-neutral-900 bg-black/5 dark:text-white dark:bg-white/5'
                        : 'text-neutral-600 dark:text-neutral-300' }}">

                <!-- Senior Citizens Icon (Solid Style) -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 shrink-0"
                    aria-hidden="true">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7 6a2 2 0 114 0 2 2 0 01-4 0ZM5.5 9A1.5 1.5 0 004 10.5v9a1 1 0 102 0v-4h1v4a1 1 0 102 0v-6h.25a.75.75 0 000-1.5H9v-1A2.5 2.5 0 006.5 9h-1ZM16 5a2 2 0 114 0 2 2 0 01-4 0Zm2.25 4A2.25 2.25 0 0016 11.25V21a1 1 0 102 0v-6h.5v6a1 1 0 102 0v-9.75A2.25 2.25 0 0018.25 9h-0.5Z" />
                </svg>

                <span>Senior Citizens</span>
            </a>
            <a href="{{ route('admin.events') }}"
                class="flex items-center rounded-sm gap-2 px-2 py-1.5 text-sm font-medium text-neutral-600 underline-offset-2
                    hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden
                    dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white
                    {{ request()->routeIs('admin.events')
                        ? 'text-neutral-900 bg-black/5 dark:text-white dark:bg-white/5'
                        : 'text-neutral-600 dark:text-neutral-300' }}">

                <!-- events Icon (Solid Style) -->
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="shrink-0 size-5" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v14a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zM4 8h16v12H4V8zm6.293 6.293a1 1 0 011.414 0L13 15.586l3.293-3.293a1 1 0 011.414 1.414L13 18.414l-2.707-2.707a1 1 0 010-1.414z" />
                </svg>

                <span>Events</span>
            </a>

            <a href="{{ route('admin.barangay') }}"
                class="flex items-center rounded-sm gap-2 px-2 py-1.5 text-sm font-medium text-neutral-600 underline-offset-2
                hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden
                dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white
                {{ request()->routeIs('admin.barangay')
                    ? 'text-neutral-900 bg-black/5 dark:text-white dark:bg-white/5'
                    : 'text-neutral-600 dark:text-neutral-300' }}">

                <!-- Barangay Icon (Solid) -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 shrink-0"
                    aria-hidden="true">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M3 10.5a1 1 0 011-1h3.586l3-3A2 2 0 0112 6h0a2 2 0 011.414.586l3 3H20a1 1 0 011 1V20a1 1 0 01-1 1h-5v-5a2 2 0 00-2-2h-2a2 2 0 00-2 2v5H4a1 1 0 01-1-1v-9.5ZM10 21v-5h4v5h-4Z" />
                </svg>

                <span>Barangay</span>
            </a>

            <a href="{{ route('admin.soloParents') }}"
                class="flex items-center rounded-sm gap-2 px-2 py-1.5 text-sm font-medium text-neutral-600 underline-offset-2
                hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden
                dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white
                {{ request()->routeIs('admin.soloParents')
                    ? 'text-neutral-900 bg-black/5 dark:text-white dark:bg-white/5'
                    : 'text-neutral-600 dark:text-neutral-300' }}">

                <!-- Barangay Icon (Solid) -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="size-5 shrink-0">
                    <path
                        d="M12 2a3 3 0 1 1-3 3 3 3 0 0 1 3-3ZM9 8a4 4 0 0 0-4 4v8.5a1.5 1.5 0 0 0 3 0V18h1v2.5a1.5 1.5 0 0 0 3 0V12a4 4 0 0 0-4-4Z" />
                    <circle cx="17" cy="9" r="2" />
                    <path
                        d="M16 11h2a2 2 0 0 1 2 2v6.5a1.5 1.5 0 0 1-3 0V15h-1v4.5a1.5 1.5 0 0 1-3 0V13a2 2 0 0 1 2-2Z" />
                </svg>


                <span>Solo Parents</span>
            </a>


            {{-- <a href=""
                class="flex items-center rounded-sm gap-2 px-2 py-1.5 text-sm font-medium text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white {{ request()->routeIs('profile.edit')
                    ? 'text-neutral-900 bg-black/5 dark:text-white dark:bg-white/5'
                    : 'text-neutral-600 dark:text-neutral-300' }}">
                <!-- Calendar Check (Solid Black) -->
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="shrink-0 size-5" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v14a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zM4 8h16v12H4V8zm6.293 6.293a1 1 0 011.414 0L13 15.586l3.293-3.293a1 1 0 011.414 1.414L13 18.414l-2.707-2.707a1 1 0 010-1.414z" />
                </svg>
                <span>Attendance</span>

            </a> --}}

            <a href="{{ route('profile.edit') }}"
                class="flex items-center rounded-sm gap-2 px-2 py-1.5 text-sm font-medium text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white {{ request()->routeIs('profile.edit')
                    ? 'text-neutral-900 bg-black/5 dark:text-white dark:bg-white/5'
                    : 'text-neutral-600 dark:text-neutral-300' }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0"
                    aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M10 2a6 6 0 0 0-6 6c0 1.887-.454 3.665-1.257 5.234a.75.75 0 0 0 .515 1.076 32.91 32.91 0 0 0 3.256.508 3.5 3.5 0 0 0 6.972 0 32.903 32.903 0 0 0 3.256-.508.75.75 0 0 0 .515-1.076A11.448 11.448 0 0 1 16 8a6 6 0 0 0-6-6ZM8.05 14.943a33.54 33.54 0 0 0 3.9 0 2 2 0 0 1-3.9 0Z"
                        clip-rule="evenodd" />
                </svg>
                <span>Profile</span>
            </a>

            <a href="#"
                class="flex items-center rounded-sm gap-2 px-2 py-1.5 text-sm font-medium text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-300 dark:hover:bg-white/5 dark:hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0"
                    aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M7.84 1.804A1 1 0 0 1 8.82 1h2.36a1 1 0 0 1 .98.804l.331 1.652a6.993 6.993 0 0 1 1.929 1.115l1.598-.54a1 1 0 0 1 1.186.447l1.18 2.044a1 1 0 0 1-.205 1.251l-1.267 1.113a7.047 7.047 0 0 1 0 2.228l1.267 1.113a1 1 0 0 1 .206 1.25l-1.18 2.045a1 1 0 0 1-1.187.447l-1.598-.54a6.993 6.993 0 0 1-1.929 1.115l-.33 1.652a1 1 0 0 1-.98.804H8.82a1 1 0 0 1-.98-.804l-.331-1.652a6.993 6.993 0 0 1-1.929-1.115l-1.598.54a1 1 0 0 1-1.186-.447l-1.18-2.044a1 1 0 0 1 .205-1.251l1.267-1.114a7.05 7.05 0 0 1 0-2.227L1.821 7.773a1 1 0 0 1-.206-1.25l1.18-2.045a1 1 0 0 1 1.187-.447l1.598.54A6.992 6.992 0 0 1 7.51 3.456l.33-1.652ZM10 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                        clip-rule="evenodd" />
                </svg>
                <span>Settings</span>
            </a>
        </div>
    </nav>

    <!-- main content  -->
    <div id="main-content" class="h-svh w-full overflow-y-auto bg-gray-200 ">
        <!-- Add main content here  -->
        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="h-full ">
            {{ $slot }}
        </main>
    </div>

    <!-- toggle button for small screen  -->
    <button
        class="fixed right-4 top-4 z-20 rounded-full bg-black p-4 md:hidden text-neutral-100 dark:bg-white dark:text-black"
        x-on:click="showSidebar = ! showSidebar">
        <svg x-show="showSidebar" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
            class="size-5" aria-hidden="true">
            <path
                d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
        </svg>
        <svg x-show="! showSidebar" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
            class="size-5" aria-hidden="true">
            <path
                d="M0 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm5-1v12h9a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zM4 2H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h2z" />
        </svg>
        <span class="sr-only">sidebar toggle</span>
    </button>
</div>
